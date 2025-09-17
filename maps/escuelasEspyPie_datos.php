<?php
require 'conexion.php';

$sql = "select * from oe_mapa_formato_web";

$stmt = $pdo->query($sql);
$geos = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $geos[] = [
        'selector' => $row['selector'],
        'nombre' => $row['nombre'],
        'tipo' => $row['tipo'],
        'comuna' => $row['comuna'],
        'region' => $row['region'],
        'direccion' => $row['direccion'],
        'latitud' => trim($row['latitud']),
        'longitud' => trim($row['longitud']),
        'email' => $row['email'],
        'telefono' => $row['telefono'],
        'web' => $row['web']
    ];
}

header('Content-Type: application/json');
echo json_encode($geos);
?>
