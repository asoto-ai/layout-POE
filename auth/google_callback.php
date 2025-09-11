<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/db.php'; // ⚠️ Ajusta según tu conexión PDO

$client = new Google_Client();
$client->setClientId($app['google_client_id']);
$client->setClientSecret($app['google_client_secret']);
$client->setRedirectUri($app['oauth_redirect_url']);

// Validar si Google devolvió "code"
if (!isset($_GET['code'])) {
    die("❌ Error en callback: falta parámetro 'code'");
}

try {
    // Intercambiar el "code" por token
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (isset($token['error'])) {
        throw new Exception("Error en token: " . $token['error_description']);
    }

    $client->setAccessToken($token);

    // Obtener perfil del usuario
    $oauth2 = new Google_Service_Oauth2($client);
    $googleUser = $oauth2->userinfo->get();

    $email = $googleUser->email;
    $name  = $googleUser->name ?? $googleUser->givenName . ' ' . $googleUser->familyName;

    // Validar dominio permitido (si está configurado en app.php)
    if (!empty($app['allowed_domain'])) {
        $domain = substr(strrchr($email, "@"), 1);
        if ($domain !== $app['allowed_domain']) {
            die("❌ Acceso denegado: dominio no permitido ($domain)");
        }
    }

    // Buscar usuario en BD (ahora con role_id)
    $sql = "SELECT 
                u.id, 
                u.name, 
                u.email, 
                COALESCE(r.id, 1)   AS role_id,
                COALESCE(r.code, 'public') AS role,
                COALESCE(r.name, 'Público') AS role_label
            FROM users u
            LEFT JOIN user_roles ur ON ur.user_id = u.id
            LEFT JOIN roles r ON r.id = ur.role_id
            WHERE u.email = ?
            LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        // Crear usuario nuevo con rol "public" (id = 1 en roles)
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("INSERT INTO users (name, email, password_hash, is_active) 
                               VALUES (?, ?, ?, 1)");
        $stmt->execute([$name, $email, password_hash(bin2hex(random_bytes(8)), PASSWORD_BCRYPT)]);
        $userId = $pdo->lastInsertId();

        $stmt = $pdo->prepare("INSERT INTO user_roles (user_id, role_id) VALUES (?, 1)");
        $stmt->execute([$userId]);

        $pdo->commit();

        $user = [
            'id'         => $userId,
            'name'       => $name,
            'email'      => $email,
            'role_id'    => 1,
            'role'       => 'public',
            'role_label' => 'Público'
        ];
    }

    // Crear sesión unificada
    $_SESSION['user'] = [
        'id'        => (int)$user['id'],
        'name'      => $user['name'],
        'email'     => $user['email'],
        'role'      => $user['role'] ?? 'public',
        'role_id'   => (int)($user['role_id'] ?? 1),   // 👈 agregado
        'role_name' => $user['role_label'] ?? 'Público'
    ];

    // 🚫 Bloquear acceso a "public"
    if ($_SESSION['user']['role'] === 'public') {
        header("Location: ../login.htm?noaccess=1");
        exit;
    }

    // ✅ Redirigir al portal según rol
    if ($_SESSION['user']['role'] === 'admin') {
        header("Location: ../portal.php#admin");
    } elseif ($_SESSION['user']['role'] === 'ally') {
        header("Location: ../portal.php#ally");
    } else {
        header("Location: ../portal.php");
    }
    exit;

} catch (Exception $e) {
    die("❌ Error en callback: " . $e->getMessage());
}
