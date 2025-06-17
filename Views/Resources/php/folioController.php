<?php
// Habilitar la visualización de errores para la depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir archivos necesarios
require '../../../Models/Connection.php'; // Ajusta la ruta según tu estructura de carpetas
require 'folioModel.php';

// Comprobar si se ha pasado la acción correcta y la tabla en la solicitud
if (isset($_GET['action']) && $_GET['action'] === 'getNewFolio' && isset($_GET['table'])) {
    $table = $_GET['table']; // Obtener la tabla a consultar

    try {
        // Depuración: Log de la tabla que se está consultando
        error_log('Tabla consultada: ' . $table);

        $db = Connection::connectionBD();
        $folioModel = new FolioModel($db);
        
        // Obtener el último folio de la tabla especificada
        $ultimoFolio = $folioModel->getLastFolio($table);
        
        // Enviar el último folio como respuesta JSON
        echo json_encode(['ultimoFolio' => $ultimoFolio]);
    } catch (Exception $e) {
        // En caso de error, registrar el error y enviar una respuesta de error en JSON
        error_log('Excepción en folioController: ' . $e->getMessage());
        echo json_encode(['error' => 'Error al obtener el último folio.']);
    }
} else {
    // Enviar una respuesta de error si la acción no es válida o la tabla no está definida
    echo json_encode(['error' => 'Acción no válida o parámetro "table" no definido.']);
}
?>
