<?php
require 'conexion.php';

$sql = "select * from oe_talleres_Deportivos_OE_web";

$stmt = $pdo->query($sql);
$geos = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $geos[] = [
        'selector'  => $row['selector'],
        'lugar'    => trim($row['lugar']) !== '' ? trim($row['lugar']) : 'Por definir',
        'nombre'    => trim($row['region']) !== '' ? trim($row['region']) : 'Por definir',
        'deporte'   => ucwords(strtolower(trim($row['deporte']))),
        'tipo'      => $row['tipo'],
        'comuna'    => $row['comuna'],
        'region'    => $row['region'],
        'direccion' => trim($row['direccion']) !== '' ? trim($row['direccion']) : 'Por definir',
        'latitud'   => trim($row['latitud']),
        'longitud'  => trim($row['longitud']),
        'email'     => $row['email'],
        'telefono'  => $row['telefono'],
        'web'       => $row['web']
    ];
}

header('Content-Type: application/json');
echo json_encode($geos);
?>
