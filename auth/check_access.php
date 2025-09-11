<?php
// auth/check_access.php
session_start();

// Si no hay sesión, redirige al login
if (!isset($_SESSION['user'])) {
    header("Location: ../login.htm");
    exit;
}

// Rol del usuario en sesión
$role = $_SESSION['user']['role'] ?? 'public';

// 🚫 Bloquear público de inmediato
if ($role === 'public') {
    header("Location: ../login.htm?noaccess=1");
    exit;
}
