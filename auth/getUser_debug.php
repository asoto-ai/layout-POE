<?php
// auth/getUser_debug.php
session_start();
header('Content-Type: application/json');

echo json_encode([
    "ok" => true,
    "raw_session" => $_SESSION,          // todo lo que tenga la sesión
    "user" => $_SESSION['user'] ?? null  // lo que normalmente usas en getUser.php
], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
