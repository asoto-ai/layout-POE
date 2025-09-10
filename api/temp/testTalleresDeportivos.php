<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';

// Cabecera para devolver JSON
header('Content-Type: application/json; charset=utf-8');

// Apunta al JSON de credenciales
putenv('GOOGLE_APPLICATION_CREDENTIALS=/home/olimpiadasespeci/cred/plataforma-oe-470319-586b01939a8e.json');

// Crear cliente
$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->addScope(Google_Service_Sheets::SPREADSHEETS);

$service = new Google_Service_Sheets($client);

// ID de la planilla
$spreadsheetId = "1NyUblF1gplvJJ-H1cluODDhfoT86ppUo90wkOsolfTI"; 
$range = "Talleres Deportivos Alianzas Institucionales v2!A:AB";

try {
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();

    if (empty($values)) {
        echo json_encode([
            "status" => "error",
            "message" => "No se encontraron datos en el rango especificado"
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    // La primera fila son los encabezados
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
        "data" => $data
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
