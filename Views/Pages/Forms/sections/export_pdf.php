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
        // Preparar la declaración para obtener los datos
        $stmt = $pdo->prepare("
            SELECT 
                s.id, s.noEmpleado, s.idDepartamento, s.nombreEmpleado, s.apellidoPaterno, s.apellidoMaterno, s.emailEmpleado, s.telefono,
                s.folio, s.Prioridad, s.gestiona, s.fecha_pedido, s.fecha_entrega, s.fines_utilizacion, s.nombre_solicitud, s.firma_solicitud,
                s.nombre_jefe, s.correo_jefe, s.nombre_recibe, s.firma_recibe, s.firma_jefe_recibe, s.solicitando,
                sm.partida, sm.cantidad, sm.unidad, sm.descripcion
            FROM solimercaservi s
            LEFT JOIN mercancias_servicios sm ON s.id = sm.soliMercaServi_id
            WHERE s.id = :id
        ");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($data) {
            // Crear el documento PDF
            $dompdf = new Dompdf();
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', true);
            $options->set('isRemoteEnabled', true); // Permitir la carga de imágenes externas
            $dompdf->setOptions($options);

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
                        .content { 
                            max-width: 800px;
                            margin: 0 auto;
                            background-color: #fff;
                            padding: 20px;
                            border-radius: 10px;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        }
                        .info-table {
                            width: 100%;
                            margin-bottom: 20px;
                            border: none; /* Eliminar el borde de la tabla */
                        }
                        .info-table th, .info-table td {
                            padding: 8px;
                            text-align: left; /* Alineación izquierda por defecto */
                        }
                        .info-table th {
                            background-color: #f2f2f2;
                            color: #333;
                        }
                        .table {
                            width: 100%;
                            border-collapse: collapse;
                            margin-top: 20px;
                        }
                        .table th, .table td {
                            padding: 8px;
                            border: 1px solid #ddd;
                            text-align: center; /* Centrando contenido de la tabla */
                        }
                        .table th {
                            background-color: #f2f2f2;
                            color: #333;
                        }
                        .field-label {
                            font-weight: bold;
                        }
                        .content img { 
                            max-width: 100%; 
                            height: auto; 
                            margin-top: 10px; 
                        }
                    </style>';

            $html .= '<h1>Harinera de Oriente</h1>';
            $html .= '<h2>F-CMP-01 Solicitud de mercancía o servicio Rev. 02</h2>';
            $html .= '<div class="content">';

            // Datos principales
            $html .= '<h2>Información Principal</h2>';
            $html .= '<table class="info-table">';
            foreach ($data[0] as $key => $value) {
                if ($key === 'id' || $key === 'partida' || $key === 'cantidad' || $key === 'unidad' || $key === 'descripcion') {
                    // Omite el campo id y los campos de mercancias_servicios de la tabla principal
                    continue;
                }

                $label = '';

                switch ($key) {
                    case 'noEmpleado':
                        $label = 'Número de Empleado';
                        break;
                    case 'idDepartamento':
                        $label = 'ID del Departamento';
                        break;
                    case 'nombreEmpleado':
                        $label = 'Nombre del Empleado';
                        break;
                    case 'apellidoPaterno':
                        $label = 'Apellido Paterno';
                        break;
                    case 'apellidoMaterno':
                        $label = 'Apellido Materno';
                        break;
                    case 'emailEmpleado':
                        $label = 'Correo Electrónico';
                        break;
                    case 'telefono':
                        $label = 'Teléfono';
                        break;
                    case 'folio':
                        $label = 'Folio';
                        break;
                    case 'Prioridad':
                        $label = 'Prioridad';
                        break;
                    case 'gestiona':
                        $label = 'Gestiona';
                        break;
                    case 'fecha_pedido':
                        $label = 'Fecha de Pedido';
                        break;
                    case 'fecha_entrega':
                        $label = 'Fecha de Entrega';
                        break;
                    case 'fines_utilizacion':
                        $label = 'Fines de Utilización';
                        break;
                    case 'nombre_solicitud':
                        $label = 'Nombre de Solicitud';
                        break;
                    case 'firma_solicitud':
                        $label = 'Firma de Solicitud';
                        break;
                    case 'nombre_jefe':
                        $label = 'Nombre del Jefe';
                        break;
                    case 'correo_jefe':
                        $label = 'Correo del Jefe';
                        break;
                    case 'nombre_recibe':
                        $label = 'Nombre de Recibe';
                        break;
                    case 'firma_recibe':
                        $label = 'Firma de Recibe';
                        break;
                    case 'firma_jefe_recibe':
                        $label = 'Firma del Jefe que Recibe';
                        break;
                    case 'solicitando':
                        $label = 'Solicitando';
                        break;
                    default:
                        $label = $key;
                        break;
                }

                $html .= '<tr><td class="field-label">' . htmlspecialchars($label) . ':</td><td>' . htmlspecialchars($value) . '</td></tr>';
            }
            $html .= '</table>';

            // Datos de mercancias_servicios
            $html .= '<h2>Detalles de Mercancías/Servicios</h2>';
            $html .= '<table class="table">';
            $html .= '<thead><tr><th>Partida</th><th>Cantidad</th><th>Unidad</th><th>Descripción</th></tr></thead>';
            $html .= '<tbody>';

            foreach ($data as $row) {
                if (isset($row['partida'])) {
                    $html .= '<tr>';
                    $html .= '<td>' . htmlspecialchars($row['partida']) . '</td>';
                    $html .= '<td>' . htmlspecialchars($row['cantidad']) . '</td>';
                    $html .= '<td>' . htmlspecialchars($row['unidad']) . '</td>';
                    $html .= '<td>' . htmlspecialchars($row['descripcion']) . '</td>';
                    $html .= '</tr>';
                }
            }
            $html .= '</tbody>';
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
