<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';

header('Content-Type: application/json; charset=utf-8');

// Ruta a credenciales
putenv('GOOGLE_APPLICATION_CREDENTIALS=/home/olimpiadasespeci/cred/plataforma-oe-470319-586b01939a8e.json');

// Cliente Google
$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->addScope(Google_Service_Sheets::SPREADSHEETS);
$service = new Google_Service_Sheets($client);

// Parámetros
$spreadsheetId = $_GET['id'] ?? null;
$sheetName     = $_GET['hoja'] ?? null;
$filtros       = $_GET['filtros'] ?? null; // Ej: "Codigo_taller:T004,Estado:Activo"
$method        = $_SERVER['REQUEST_METHOD'];

if (!$spreadsheetId || !$sheetName) {
    echo json_encode(["status" => "error", "message" => "Faltan parámetros: id y hoja"]);
    exit;
}

// ===== Auxiliares =====
function leerHoja($service, $spreadsheetId, $sheetName) {
    $response = $service->spreadsheets_values->get($spreadsheetId, $sheetName);
    $values = $response->getValues();
    if (empty($values)) return [];

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
    return ["headers" => $headers, "rows" => $data];
}

function parseFiltros($filtros) {
    $condiciones = [];
    if ($filtros) {
        $pares = explode(",", $filtros);
        foreach ($pares as $par) {
            [$campo, $valor] = array_map('trim', explode(":", $par, 2));
            if ($campo && $valor !== null) {
                $condiciones[$campo] = $valor;
            }
        }
    }
    return $condiciones;
}

function filaPorFiltros($datos, $condiciones) {
    foreach ($datos["rows"] as $i => $row) {
        $cumple = true;
        foreach ($condiciones as $campo => $valor) {
            if (!isset($row[$campo]) || $row[$campo] != $valor) {
                $cumple = false;
                break;
            }
        }
        if ($cumple) {
            return $i + 2; // fila real en Sheets (1=encabezado, +1 porque array inicia en 0)
        }
    }
    return null;
}

// ===== CRUD =====
try {
    switch ($method) {
        case 'GET': // READ
            $datos = leerHoja($service, $spreadsheetId, $sheetName);
            $condiciones = parseFiltros($filtros);

            if (!$condiciones) {
                echo json_encode(["status" => "ok", "data" => $datos["rows"]], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            } else {
                $filtro = array_values(array_filter($datos["rows"], function($row) use ($condiciones) {
                    foreach ($condiciones as $campo => $valor) {
                        if (!isset($row[$campo]) || $row[$campo] != $valor) return false;
                    }
                    return true;
                }));
                echo json_encode(["status" => "ok", "data" => $filtro], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            }
            break;

        case 'POST': // CREATE
            $input = json_decode(file_get_contents("php://input"), true);
            if (!$input) {
                echo json_encode(["status" => "error", "message" => "Body vacío o inválido"]);
                exit;
            }
            $body = new Google_Service_Sheets_ValueRange(['values' => [array_values($input)]]);
            $params = ['valueInputOption' => 'RAW'];
            $service->spreadsheets_values->append($spreadsheetId, $sheetName, $body, $params);
            echo json_encode(["status" => "ok", "message" => "Fila insertada"], JSON_UNESCAPED_UNICODE);
            break;

        case 'PUT': // UPDATE
            $condiciones = parseFiltros($filtros);
            if (!$condiciones) {
                echo json_encode(["status" => "error", "message" => "Se requiere al menos un filtro para UPDATE"]);
                exit;
            }
            $input = json_decode(file_get_contents("php://input"), true);
            if (!$input) {
                echo json_encode(["status" => "error", "message" => "Body vacío o inválido"]);
                exit;
            }

            $datos = leerHoja($service, $spreadsheetId, $sheetName);
            $fila = filaPorFiltros($datos, $condiciones);
            if (!$fila) {
                echo json_encode(["status" => "error", "message" => "No se encontró fila con filtros dados"]);
                exit;
            }

            $valoresActualizados = [];
            foreach ($datos["headers"] as $col => $header) {
                $valoresActualizados[] = $input[$header] ?? $datos["rows"][$fila-2][$header] ?? null;
            }

            $range = $sheetName . "!A" . $fila;
            $body = new Google_Service_Sheets_ValueRange(['values' => [$valoresActualizados]]);
            $params = ['valueInputOption' => 'RAW'];
            $service->spreadsheets_values->update($spreadsheetId, $range, $body, $params);

            echo json_encode(["status" => "ok", "message" => "Fila actualizada"], JSON_UNESCAPED_UNICODE);
            break;

        case 'DELETE': // DELETE
            $condiciones = parseFiltros($filtros);
            if (!$condiciones) {
                echo json_encode(["status" => "error", "message" => "Se requiere al menos un filtro para DELETE"]);
                exit;
            }

            $datos = leerHoja($service, $spreadsheetId, $sheetName);
            $fila = filaPorFiltros($datos, $condiciones);
            if (!$fila) {
                echo json_encode(["status" => "error", "message" => "No se encontró fila con filtros dados"]);
                exit;
            }

            $meta = $service->spreadsheets->get($spreadsheetId);
            $sheetId = null;
            foreach ($meta->getSheets() as $s) {
                if ($s['properties']['title'] === $sheetName) {
                    $sheetId = $s['properties']['sheetId'];
                    break;
                }
            }
            if ($sheetId === null) {
                echo json_encode(["status" => "error", "message" => "No se encontró el sheetId para la hoja $sheetName"]);
                exit;
            }

            $requestBody = new Google_Service_Sheets_BatchUpdateSpreadsheetRequest([
                'requests' => [[
                    'deleteDimension' => [
                        'range' => [
                            'sheetId' => $sheetId,
                            'dimension' => 'ROWS',
                            'startIndex' => $fila-1,
                            'endIndex'   => $fila
                        ]
                    ]
                ]]
            ]);
            $service->spreadsheets->batchUpdate($spreadsheetId, $requestBody);
            echo json_encode(["status" => "ok", "message" => "Fila eliminada"], JSON_UNESCAPED_UNICODE);
            break;

        default:
            echo json_encode(["status" => "error", "message" => "Método no soportado"]);
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
