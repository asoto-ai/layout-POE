<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';

// ====== Cabecera para devolver JSON ======
header('Content-Type: application/json; charset=utf-8');

// ====== Ruta al JSON de credenciales ======
putenv('GOOGLE_APPLICATION_CREDENTIALS=/home/olimpiadasespeci/cred/plataforma-oe-470319-586b01939a8e.json');

// ====== Crear cliente ======
$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->addScope(Google_Service_Sheets::SPREADSHEETS);
$service = new Google_Service_Sheets($client);

// ====== Parámetros desde la URL ======
// ?id=SPREADSHEET_ID&hoja=NOMBRE_HOJA&range=A:Z
$spreadsheetId = $_GET['id'] ?? null;
$sheetName     = $_GET['hoja'] ?? null;
$rangeColumns  = $_GET['range'] ?? null;

// Validación
if (!$spreadsheetId || !$sheetName) {
    echo json_encode([
        "status" => "error",
        "message" => "Faltan parámetros: id (spreadsheetId) y hoja (nombre de pestaña)"
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

// Construir rango completo
$range = $sheetName;
if ($rangeColumns) {
    $range .= "!" . $rangeColumns;
}

try {
    // Obtener valores
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();

    if (empty($values)) {
        echo json_encode([
            "status" => "error",
            "message" => "No se encontraron datos en la hoja/rango especificado"
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    // Primera fila = encabezados
    $headers = array_map('trim', $values[0]);
    $rows = array_slice($values, 1);

    $data = [];
    foreach ($rows as $row) {
        $item = [];
        foreach ($headers as $i => $header) {
            $item[$header] = $row[$i] ?? null;
        }
        $data[] = $item;
    }

    echo json_encode([
        "status" => "ok",
        "spreadsheetId" => $spreadsheetId,
        "sheet" => $sheetName,
        "total" => count($data),
        "data" => $data
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
