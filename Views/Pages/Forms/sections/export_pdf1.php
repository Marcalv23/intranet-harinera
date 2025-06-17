<?php
require_once '../../../../Models/Connection.php';
require_once '../../../../vendor/autoload.php'; // Incluye la biblioteca de generación de PDFs

use Dompdf\Dompdf;
use Dompdf\Options;

// Obtener el ID del POST
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($id > 0) {
    $pdo = Connection::connectionBD();

    try {
        // Consultar los datos principales
        $stmt = $pdo->prepare("
            SELECT e.id, 
                   e.noEmpleado, 
                   d.nombre AS nombreDepartamento, 
                   e.nombreEmpleado, 
                   e.apellidoPaterno, 
                   e.apellidoMaterno, 
                   e.emailEmpleado, 
                   e.telefono,
                   e.folio, 
                   e.fecha_solicitud, 
                   e.propietario_equipo, 
                   e.entrada_salida, 
                   e.fecha_devolucion, 
                   e.motivo, 
                   e.evidencia,
                   e.nombre_colaborador, 
                   e.firma_responsable, 
                   e.aceptacion_responsabilidad, 
                   e.nombre_autorizador, 
                   e.correo_autorizador, 
                   e.firma_autorizador
            FROM escolaboradores e
            LEFT JOIN departamento d ON e.idDepartamento = d.idDepto
            WHERE e.id = :id
        ");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        // Consultar las características del equipo asociadas
        $stmt = $pdo->prepare("
            SELECT tipo_equipo, marca, modelo, numero_serie
            FROM caracteristicasescolaboradores
            WHERE ESColaboradores_id = :id
        ");
        $stmt->execute(['id' => $id]);
        $caracteristicas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($data) {
            // Crear el documento PDF
            $dompdf = new Dompdf();
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', true);
            $dompdf->setOptions($options);

            // Generar contenido HTML para el PDF
            $html = '
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Detalles de Respuesta</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        margin: 0;
                        padding: 0;
                        color: #333;
                    }
                    .container {
                        padding: 20px;
                        text-align: center;
                    }
                    h1{
                        color: #ff0000;
                            font-size: 30px;
                            text-align: center; /* Alineación central del título */
                            margin: 20px 0; 
                    }
                    h2 {
                        color: #333333;
                            font-size: 22px;
                            margin: 20px 0;
                            text-align: center; /* Alineación central del subtítulo */
                    }
                    .info-table {
                        width: 100%;
                        margin-bottom: 20px;
                    }
                    .info-table th, .info-table td {
                        padding: 10px;
                        text-align: left;
                    }
                    .info-table th {
                        background-color: #fff;
                    }
                    .info-table tbody tr:nth-child(even) {
                        background-color: #fff;
                    }
                    .equipment-table {
                        margin: 0 auto;
                        border-collapse: collapse;
                        width: 80%;
                    }
                    .equipment-table th, .equipment-table td {
                        padding: 10px;
                        text-align: left;
                        border: 1px solid #ddd;
                    }
                    .equipment-table th {
                        background-color: #f2f2f2;
                    }
                    .equipment-table tbody tr:nth-child(even) {
                        background-color: #f9f9f9;
                    }
                    .image {
                        max-width: 100px;
                        max-height: 100px;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <h1>Harinera de Oriente</h1>
                    <h2>F-GES-04 Entrada/salida de equipo de cómputo (colaboradores) REV. 01</h2>
                    <table class="info-table">
                        <tbody>
                            <tr><th>ID</th><td>' . htmlspecialchars($data['id']) . '</td></tr>
                            <tr><th>No. Empleado</th><td>' . htmlspecialchars($data['noEmpleado']) . '</td></tr>
                            <tr><th>Departamento</th><td>' . htmlspecialchars($data['nombreDepartamento']) . '</td></tr>
                            <tr><th>Nombre</th><td>' . htmlspecialchars($data['nombreEmpleado']) . '</td></tr>
                            <tr><th>Apellido Paterno</th><td>' . htmlspecialchars($data['apellidoPaterno']) . '</td></tr>
                            <tr><th>Apellido Materno</th><td>' . htmlspecialchars($data['apellidoMaterno']) . '</td></tr>
                            <tr><th>Email</th><td>' . htmlspecialchars($data['emailEmpleado']) . '</td></tr>
                            <tr><th>Teléfono</th><td>' . htmlspecialchars($data['telefono']) . '</td></tr>
                            <tr><th>Folio</th><td>' . htmlspecialchars($data['folio']) . '</td></tr>
                            <tr><th>Fecha de Solicitud</th><td>' . htmlspecialchars($data['fecha_solicitud']) . '</td></tr>
                            <tr><th>Propietario del Equipo</th><td>' . htmlspecialchars($data['propietario_equipo']) . '</td></tr>
                            <tr><th>Entrada/Salida</th><td>' . htmlspecialchars($data['entrada_salida']) . '</td></tr>
                            <tr><th>Fecha de Devolución</th><td>' . htmlspecialchars($data['fecha_devolucion']) . '</td></tr>
                            <tr><th>Motivo</th><td>' . htmlspecialchars($data['motivo']) . '</td></tr>
                            <tr><th>Evidencia</th><td>';

            // Mostrar imágenes de evidencia
            $evidencias = explode(',', $data['evidencia']);
            foreach ($evidencias as $evidencia) {
                $html .= '<img class="image" src="Views/Resources/php/uploads/' . htmlspecialchars(trim($evidencia)) . '" alt="Evidencia">';
            }

            $html .= '</td></tr>
                            <tr><th>Nombre del Colaborador</th><td>' . htmlspecialchars($data['nombre_colaborador']) . '</td></tr>
                            <tr><th>Firma del Responsable</th><td>' . htmlspecialchars($data['firma_responsable']) . '</td></tr>
                            <tr><th>Aceptación de Responsabilidad</th><td>' . htmlspecialchars($data['aceptacion_responsabilidad']) . '</td></tr>
                            <tr><th>Nombre del Autorizador</th><td>' . htmlspecialchars($data['nombre_autorizador']) . '</td></tr>
                            <tr><th>Correo del Autorizador</th><td>' . htmlspecialchars($data['correo_autorizador']) . '</td></tr>
                            <tr><th>Firma del Autorizador</th><td>' . htmlspecialchars($data['firma_autorizador']) . '</td></tr>
                        </tbody>
                    </table>
                    <h2>Características del Equipo</h2>
                    <table class="equipment-table">
                        <thead>
                            <tr>
                                <th>Tipo de Equipo</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Número de Serie</th>
                            </tr>
                        </thead>
                        <tbody>';

            foreach ($caracteristicas as $caracteristica) {
                $html .= '
                            <tr>
                                <td>' . htmlspecialchars($caracteristica['tipo_equipo']) . '</td>
                                <td>' . htmlspecialchars($caracteristica['marca']) . '</td>
                                <td>' . htmlspecialchars($caracteristica['modelo']) . '</td>
                                <td>' . htmlspecialchars($caracteristica['numero_serie']) . '</td>
                            </tr>';
            }

            $html .= '
                        </tbody>
                    </table>
                </div>
            </body>
            </html>';

            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            // Enviar PDF como archivo descargable
            $dompdf->stream('documento.pdf', ['Attachment' => 0]);

            // Nota: No es necesario retornar JSON aquí si solo generas el PDF
        } else {
            // Retorna una respuesta JSON si deseas manejar esto en el cliente
            echo json_encode(['success' => false, 'error' => 'Datos no encontrados']);
        }
    } catch (PDOException $e) {
        // Maneja los errores y retorna una respuesta JSON si es necesario
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    // Retorna una respuesta JSON si deseas manejar esto en el cliente
    echo json_encode(['success' => false, 'error' => 'ID inválido']);
}
?>
