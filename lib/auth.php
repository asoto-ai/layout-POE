<?php
if (session_status() === PHP_SESSION_NONE) {
  session_name('poe_session');
  session_start();
}

function auth_user() {
  return $_SESSION['user'] ?? null;
}

function auth_has_role($role) {
  $u = auth_user();
  if (!$u) return false;
  return in_array($role, $u['roles'] ?? [], true);
}

function require_login_json() {
  if (!auth_user()) {
    http_response_code(401);
    header('Content-Type: application/json');
    echo json_encode(['ok'=>false,'error'=>'UNAUTHORIZED']);
    exit;
  }
}

function require_role_json($role) {
  require_login_json();
  if (!auth_has_role($role)) {
    http_response_code(403);
    header('Content-Type: application/json');
    echo json_encode(['ok'=>false,'error'=>'FORBIDDEN']);
    exit;
  }
}
