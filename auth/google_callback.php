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

    // Buscar usuario en BD
    $sql = "SELECT u.id, u.name, u.email, r.code as role
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

        $stmt = $pdo->prepare("INSERT INTO users (name, email, password_hash, is_active) VALUES (?, ?, ?, 1)");
        $stmt->execute([$name, $email, password_hash(bin2hex(random_bytes(8)), PASSWORD_BCRYPT)]);
        $userId = $pdo->lastInsertId();

        $stmt = $pdo->prepare("INSERT INTO user_roles (user_id, role_id) VALUES (?, 1)");
        $stmt->execute([$userId]);

        $pdo->commit();

        $user = [
            'id'    => $userId,
            'name'  => $name,
            'email' => $email,
            'role'  => 'public'
        ];
    }

    // Crear sesión
    $_SESSION['user'] = $user;

    // Redirigir al portal
    header("Location: ../portal.php");
    exit;

} catch (Exception $e) {
    die("❌ Error en callback: " . $e->getMessage());
}
