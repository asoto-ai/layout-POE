<?php
$config = require __DIR__ . '/../config/app.php';
session_name($config['session_name'] ?? 'accesos_app');
session_set_cookie_params([
  'lifetime' => $config['session_lifetime'] ?? 28800,
  'path' => '/',
  'secure' => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'),
  'httponly' => true,
  'samesite' => 'Lax',
]);
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
