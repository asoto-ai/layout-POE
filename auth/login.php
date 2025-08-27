<?php
// auth/login.php
declare(strict_types=1);
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../config/db.php'; // ajusta la ruta si es distinta

try {
    // Espera POST: email, password
    $email = isset($_POST['email']) ? trim(strtolower($_POST['email'])) : '';
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        echo json_encode(['ok' => false, 'message' => 'Faltan credenciales']); exit;
    }

    // Traer usuario y su rol
$sql = "
    SELECT 
        u.id, u.name, u.email, u.password_hash, u.is_active,
        COALESCE(r.code, 'public') AS role
    FROM users u
    LEFT JOIN user_roles ur ON ur.user_id = u.id
    LEFT JOIN roles r ON r.id = ur.role_id
    WHERE u.email = ?
    LIMIT 1
";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || !$user['is_active']) {
        echo json_encode(['ok' => false, 'message' => 'Usuario no encontrado o inactivo']); exit;
    }

    if (!password_verify($password, $user['password_hash'])) {
        echo json_encode(['ok' => false, 'message' => 'Credenciales inválidas']); exit;
    }

    // Guardar datos mínimos en sesión
    $_SESSION['user'] = [
        'id'    => (int)$user['id'],
        'name'  => $user['name'],
        'email' => $user['email'],
        'role'  => $user['role'] // admin | ally | public
    ];

    echo json_encode(['ok' => true, 'user' => $_SESSION['user']]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'message' => 'Error del servidor']);
}
