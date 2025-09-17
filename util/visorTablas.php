<?php
declare(strict_types=1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../config/db.php"; // conexión PDO


// Obtener tablas
$tables = [];
$stmt = $pdo->query("SHOW TABLES");
while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
    $tables[] = $row[0];
}

// Tabla seleccionada
$selectedTable = $_GET['tabla'] ?? null;
$data = [];
$columns = [];

if ($selectedTable) {
    // Obtener columnas
    $stmt = $pdo->query("DESCRIBE `$selectedTable`");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Obtener registros
    $stmt = $pdo->query("SELECT * FROM `$selectedTable` LIMIT 200"); // limita a 200 para no explotar
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Si viene un POST de actualización
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tabla'], $_POST['id'])) {
    $tabla = $_POST['tabla'];
    $id = (int)$_POST['id'];

    $updates = [];
    $params = [];
    foreach ($_POST as $k => $v) {
        if ($k === 'tabla' || $k === 'id') continue;
        $updates[] = "`$k` = :$k";
        $params[$k] = $v === '' ? null : $v;
    }
    $params['id'] = $id;

    $sql = "UPDATE `$tabla` SET " . implode(",", $updates) . " WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    echo "<p style='color:green'>✅ Registro $id actualizado en $tabla</p>";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Visor de Tablas</title>
    <style>
        body { font-family: Arial, sans-serif; margin:20px; }
        select, button { padding:5px; margin:5px; }
        table { border-collapse: collapse; width:100%; margin-top:20px; }
        th, td { border:1px solid #ccc; padding:5px; text-align:left; }
        input[type=text] { width:100%; border:none; background:transparent; }
        input[type=text]:focus { outline:1px solid #007BFF; background:#eef; }
    </style>
</head>
<body>
    <h1>📊 Visor de Tablas</h1>

    <form method="get">
        <label>Selecciona tabla:</label>
        <select name="tabla" onchange="this.form.submit()">
            <option value="">-- elige --</option>
            <?php foreach ($tables as $t): ?>
                <option value="<?= htmlspecialchars($t) ?>" <?= $t === $selectedTable ? 'selected' : '' ?>>
                    <?= htmlspecialchars($t) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <?php if ($selectedTable && $data): ?>
        <h2>Tabla: <?= htmlspecialchars($selectedTable) ?></h2>
        <table>
            <tr>
                <?php foreach ($columns as $col): ?>
                    <th><?= htmlspecialchars($col) ?></th>
                <?php endforeach; ?>
                <th>Acción</th>
            </tr>
            <?php foreach ($data as $row): ?>
                <tr>
                    <form method="post">
                        <?php foreach ($columns as $col): ?>
                            <td>
                                <?php if ($col === 'id'): ?>
                                    <input type="text" name="id" value="<?= htmlspecialchars($row[$col]) ?>" readonly>
                                <?php else: ?>
                                    <input type="text" name="<?= htmlspecialchars($col) ?>" value="<?= htmlspecialchars($row[$col]) ?>">
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                        <td>
                            <input type="hidden" name="tabla" value="<?= htmlspecialchars($selectedTable) ?>">
                            <button type="submit">💾 Guardar</button>
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif ($selectedTable): ?>
        <p>No hay registros en esta tabla.</p>
    <?php endif; ?>
</body>
</html>
