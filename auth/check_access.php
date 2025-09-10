<?php
// auth/check_access.php
session_start();

// 🚫 Si no hay usuario en sesión → al login
if (!isset($_SESSION['user'])) {
    header("Location: ../login.htm");
    exit;
}

$role = $_SESSION['user']['role'] ?? 'public';

// 🚫 Si es público → bloqueamos
if ($role === 'public') {
    header("Location: ../login.htm?noaccess=1");
    exit;
}

// ⚡ Ejemplo de control por rol
// Solo admin entra a ciertas páginas
// if ($role !== 'admin') {
//     header("Location: ../login.htm?noaccess=1");
//     exit;
// }
