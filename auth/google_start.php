<?php
require_once __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../config/app.php';

// Secreto desde .htaccess
$clientSecret = getenv('GOOGLE_CLIENT_SECRET');
if (!$clientSecret) {
    die("Falta GOOGLE_CLIENT_SECRET en entorno");
}

$client = new Google_Client();
$client->setClientId($app['google_client_id']);
$client->setClientSecret($clientSecret);

// Redirect fijo desde config/app.php
$client->setRedirectUri($app['oauth_redirect_url']);

$client->setScopes(['email', 'profile']);
$client->setAccessType('offline');
$client->setPrompt('select_account');

// 🟢 Producción: redirigir directamente a Google
header('Location: ' . $client->createAuthUrl());
exit;
