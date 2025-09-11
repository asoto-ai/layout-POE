<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/check_access.php';

function validate_section_access(string $section, PDO $pdo): void {
    $roleId = $_SESSION['user']['role_id'] ?? 1;

    $stmt = $pdo->prepare("
        SELECT COUNT(*) 
        FROM role_permissions 
        WHERE role_id = ? AND section = ?
    ");
    $stmt->execute([$roleId, $section]);

    if ($stmt->fetchColumn() == 0) {
        http_response_code(403);
        die("<div class='alert alert-danger'>
              🚫 No tienes permiso para acceder a la sección <b>$section</b>
            </div>");
    }
}
