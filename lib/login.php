<?php
header('Content-Type: application/json');
require_once __DIR__.'/../config/db.php';
require_once __DIR__.'/auth.php';

$body = $_POST ?: json_decode(file_get_contents('php://input'), true);
$email = trim($body['email'] ?? '');
$pass  = $body['password'] ?? '';

if ($email === '' || $pass === '') {
  http_response_code(400);
  echo json_encode(['ok'=>false,'error'=>'MISSING_FIELDS']);
  exit;
}

$stmt = $pdo->prepare("SELECT id,name,email,password_hash,is_active FROM users WHERE email=? LIMIT 1");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !$user['is_active'] || !password_verify($pass, $user['password_hash'])) {
  http_response_code(401);
  echo json_encode(['ok'=>false,'error'=>'INVALID_CREDENTIALS']);
  exit;
}

$rolesStmt = $pdo->prepare("
  SELECT r.code,r.name
  FROM user_roles ur
  JOIN roles r ON r.id = ur.role_id
  WHERE ur.user_id = ?
");

$rolesStmt->execute([$user['id']]);
$role = $rolesStmt->fetch(PDO::FETCH_ASSOC); // 👈 ahora sí devuelve code y name

$roleCode = $role['code'] ?? 'public';
$roleName = $role['name'] ?? 'Público';

$_SESSION['user'] = [
  'usuario_id'   => (int)$user['id'],
  'nombre'       => $user['name'],
  'correo'       => $user['email'],
  'rol_codigo'   => $roleCode,
  'rol_nombre'   => $roleName
];


echo json_encode(['ok'=>true,'user'=>$_SESSION['user']]);

