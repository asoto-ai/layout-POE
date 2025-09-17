<?php
require 'conexion.php';

// Usamos la nueva vista con todos los campos necesarios
$sql = "select 
            Nombre_institucion nombre,
            deporte,
            lugar,
            dias_taller,
            hora,
            Comuna_localidad comuna,
            region,
            direccion,
            TRIM(SUBSTRING_INDEX(ubicacion, ',', 1)) AS latitud,
            TRIM(SUBSTRING_INDEX(ubicacion, ',', -1)) AS longitud,
            email,
            telefono,
            web,
            Edad edad,
            Genero genero
        from oe_talleres2 
        where Estado_Intervencion = 'Activo'";
$stmt = $pdo->query($sql);

$geos = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $lat = trim($row['latitud']);
    $lng = trim($row['longitud']);

    // Validar que latitud y longitud sean numéricos
    if ($lat === '' || $lng === '' || !is_numeric($lat) || !is_numeric($lng)) {
        continue;
    }

    $geos[] = [
        //'selector'  => $row['selector'],
        'nombre'    => trim($row['nombre']) !== '' ? trim($row['nombre']) : 'Por definir',
        'deporte'   => isset($row['deporte']) ? ucwords(strtolower(trim($row['deporte']))) : 'Por definir',
        'lugar'     => isset($row['lugar']) && trim($row['lugar']) !== '' ? trim($row['lugar']) : 'Por definir',
        'dias_taller' => $row['dias_taller'],
        'hora'      => $row['hora'],
        'comuna'    => $row['comuna'],
        'region'    => $row['region'],
        'direccion' => trim($row['direccion']) !== '' ? trim($row['direccion']) : 'Por definir',
        'latitud'   => floatval($lat),
        'longitud'  => floatval($lng),
        'email'     => $row['email'],
        'telefono'  => $row['telefono'],
        'web'       => $row['web'],
        'edad'       => $row['edad'],
        'genero'       => $row['genero']
    ];
}

header('Content-Type: application/json');
echo json_encode($geos);
?>
