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
        // Preparar la declaración para obtener los datos, excluyendo el ID del departamento en la selección
        $stmt = $pdo->prepare("
            SELECT r.*, d.nombre AS nombreDepartamento
            FROM reinci r
            LEFT JOIN departamento d ON r.idDepartamento = d.idDepto
            WHERE r.id = :id
        ");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            // Crear el documento PDF
            $dompdf = new Dompdf();
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', false);
            $options->set('isRemoteEnabled', true); // Permitir la carga de imágenes externas
            $dompdf->setOptions($options);

            // Define etiquetas personalizadas para los campos
            $fieldLabels = [
                'noEmpleado' => 'N de colaborador',
                'nombreDepartamento' => 'Departamento',
                'nombreEmpleado' => 'Nombre de colaborador',
                'apellidoPaterno' => 'Apellido paterno',
                'apellidoMaterno' => 'Apellido materno',
                'emailEmpleado' => 'Correo electrónico',
                'telefono' => 'Número de teléfono',
                'folio' => 'Folio',
                'fecha_reporte' => 'Fecha de reporte',
                'tipo_inc' => '¿Qué tipo de incidencia reporta?',
                'dep_rep' => '¿En qué departamento o área de la organización se tiene esta incidencia?',
                'descrip_inc' => 'Descripción de la incidencia',
                'evidencia' => 'Evidencia',
                'fecha_atencion' => 'Fecha de atención',
                'firma_de_conformidad' => 'Firma de conformidad',
                // Agrega más etiquetas aquí si es necesario
            ];

            // Generar contenido HTML para el PDF
            $html = '<style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #fff;
                            margin: 0;
                            padding: 0;
                        }
                        h1 { 
                            color: #ff0000;
                            font-size: 22px;
                            text-align: center; /* Alineación central del título */
                            margin: 20px 0; 
                        }
                        h2 { 
                            color: #333333;
                            font-size: 22px;
                            margin: 20px 0;
                            text-align: center; /* Alineación central del subtítulo */
                        }
                        .content { 
                            max-width: 800px;
                            margin: 0 auto;
                            background-color: #fff;
                            padding: 20px;
                            border-radius: 10px;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        }
                        .table {
                            width: 100%;
                            border-collapse: collapse;
                        }
                        .table th, .table td {
                            padding: 8px;
                            text-align: left;
                        }
                        .table th {
                            background-color: #f2f2f2; /* Fondo gris claro para encabezados */
                            color: #333;
                        }
                        .table td {
                            background-color: #fff;
                        }
                        .table .field-label {
                            background-color: #fff; /* Fondo gris claro para etiquetas */
                            text-align: left; /* Alineación izquierda */
                            font-weight: bold;
                        }
                        .table .field-value {
                            text-align: right; /* Alineación derecha */
                        }
                        .content img { 
                            max-width: 100%; 
                            height: auto; 
                            margin-top: 10px; 
                        }
                    </style>';

            $html .= '<h1>Harinera de Oriente</h1>';
            $html .= '<h2>F-GES-08 Reporte de incidencias informáticas</h2>';
            $html .= '<div class="content">';
            $html .= '<table class="table">';
            
            foreach ($data as $key => $value) {
                if ($key === 'id') {
                    // Omite el campo id y no lo muestra en el PDF
                    continue;
                }

                $label = isset($fieldLabels[$key]) ? $fieldLabels[$key] : htmlspecialchars($key);

                // Verificar si el campo es evidencia y tiene una imagen
                if ($key === 'evidencia' && !empty($value)) {
                    // Ruta de la imagen
                    $imagePath = '/Views/Resources/php/uploads/' . $value; // Ruta relativa desde el directorio raíz del servidor
                    
                    $fullImagePath = $_SERVER['DOCUMENT_ROOT'] . $imagePath;
                    
                    if (file_exists($fullImagePath)) {
                        $html .= '<tr>';
                        $html .= '<td class="field-label">' . $label . ':</td>';
                        $html .= '<td class="field-value"><img src="' . htmlspecialchars($imagePath) . '" alt="Evidencia"></td>';
                        $html .= '</tr>';
                    } else {
                        $html .= '<tr>';
                        $html .= '<td class="field-label">' . $label . ':</td>';
                        $html .= '<td class="field-value">Imagen no encontrada</td>';
                        $html .= '</tr>';
                    }
                } else {
                    // Mostrar el nombre del departamento en lugar del ID
                    if ($key === 'idDepartamento') {
                        $key = 'nombreDepartamento';
                    }

                    $html .= '<tr>';
                    $html .= '<td class="field-label">' . (isset($fieldLabels[$key]) ? $fieldLabels[$key] : htmlspecialchars($key)) . ':</td>';
                    $html .= '<td class="field-value">' . htmlspecialchars($value) . '</td>';
                    $html .= '</tr>';
                }
            }

            $html .= '</table>';
            $html .= '</div>';

            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            // Enviar PDF como archivo descargable
            $dompdf->stream('documento.pdf', ['Attachment' => 0]);

        } else {
            echo json_encode(['success' => false, 'error' => 'Datos no encontrados']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'ID inválido']);
}
?>
