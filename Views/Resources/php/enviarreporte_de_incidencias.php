<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;
use Dompdf\Options;

require '../../../Models/Connection.php';
require 'vendor/autoload.php';

function getRepIncidenciasEmails($conn) {
    $emails = [];
    try {
        $stmt = $conn->prepare("SELECT email FROM correosforms WHERE formName = :nombre");
        $nombre = 'repIncidencias';
        $stmt->bindParam(':nombre', $nombre);
        $stmt->execute();
        $emails = $stmt->fetchAll(PDO::FETCH_COLUMN);
    } catch (PDOException $e) {
        echo "Error al obtener correos electrónicos: " . $e->getMessage();
    }
    return $emails;
}

try {
    // Ejemplo de cadena que contiene detalles del archivo
    $evidenciaString = "Name = Captura de pantalla 2024-02-18 141055.png, Size = 49160 bytes, Type = image/png";

    // Extraer solo el nombre del archivo usando una expresión regular
    preg_match('/Name\s*=\s*([^,]+)/', $evidenciaString, $matches);
    $nombreArchivo = trim($matches[1]);

    // Mostrar el nombre del archivo extraído para depuración
    echo '<pre>';
    echo "Nombre del archivo extraído: $nombreArchivo\n";
    echo '</pre>';


    $conn = Connection::connectionBD();

    // Datos del formulario con valores predeterminados para campos vacíos
    $noEmpleado = $_POST['N_colaborador'] ?? '';
    $nombreDepartamento = $_POST['departamento'] ?? '';
    $nombreEmpleado = $_POST['N_empleado'] ?? '';
    $apellidoPaterno = $_POST['Ape_paterno'] ?? '';
    $apellidoMaterno = $_POST['Ape_materno'] ?? '';
    $emailEmpleado = $_POST['correo'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $folio = $_POST['folio'] ?? '';
    $fecha_reporte = $_POST['fecha_reporte'] ?? '';
    $tipo_inc = $_POST['tipo_inc'] ?? '';
    $dep_rep = $_POST['dep_rep'] ?? '';
    $descrip_inc = $_POST['descrip_inc'] ?? '';
    $evidencia = $_POST['evidencia'] ?? '';
    $fecha_atencion = $_POST['fecha_atencion'] ?? '';
    $firma_de_conformidad = $_POST['firma_de_conformidad'] ?? '';

    // Obtener idDepto a partir del nombre del departamento
    $stmtDepto = $conn->prepare("SELECT idDepto FROM departamento WHERE nombre = :nombreDepartamento");
    $stmtDepto->bindParam(':nombreDepartamento', $nombreDepartamento);
    $stmtDepto->execute();
    $idDepartamento = $stmtDepto->fetchColumn();

    if (!$idDepartamento) {
        throw new Exception('Departamento no encontrado.');
    }

    // Directorio donde se guardarán los archivos subidos
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Manejar la subida de archivos
    $evidenciaFiles = [];
    if (!empty($_FILES['evidenceFiles']['name'][0])) {
        foreach ($_FILES['evidenceFiles']['name'] as $key => $fileName) {
            $fileTmpName = $_FILES['evidenceFiles']['tmp_name'][$key];
            $fileSize = $_FILES['evidenceFiles']['size'][$key];
            $fileError = $_FILES['evidenceFiles']['error'][$key];
            $fileType = $_FILES['evidenceFiles']['type'][$key];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = ['jpg', 'jpeg', 'png'];

            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 5000000) { // Limitar el tamaño del archivo a 5MB
                        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                        $fileDestination = $uploadDir . $fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        $evidenciaFiles[] = $fileNameNew;
                    } else {
                        throw new Exception('El archivo es demasiado grande.');
                    }
                } else {
                    throw new Exception('Error al subir el archivo.');
                }
            } else {
                throw new Exception('Tipo de archivo no permitido.');
            }
        }
    }
    
        // Convertir los nombres de los archivos en una cadena separada por comas
        $evidencia = implode(',', $evidenciaFiles);

    // Consulta de inserción
    $query = "INSERT INTO reinci (
        noEmpleado,
        idDepartamento,
        nombreEmpleado,
        apellidoPaterno,
        apellidoMaterno,
        emailEmpleado,
        telefono,
        folio,
        fecha_reporte,
        tipo_inc,
        dep_rep,
        descrip_inc,
        evidencia,
        fecha_atencion,
        firma_de_conformidad
    ) VALUES (
        :noEmpleado,
        :idDepartamento,
        :nombreEmpleado,
        :apellidoPaterno,
        :apellidoMaterno,
        :emailEmpleado,
        :telefono,
        :folio,
        :fecha_reporte,
        :tipo_inc,
        :dep_rep,
        :descrip_inc,
        :evidencia,
        :fecha_atencion,
        :firma_de_conformidad
    )";

    // Preparar la consulta
    $stmt = $conn->prepare($query);

    // Vincular parámetros
    $stmt->bindParam(':noEmpleado', $noEmpleado);
    $stmt->bindParam(':idDepartamento', $idDepartamento);
    $stmt->bindParam(':nombreEmpleado', $nombreEmpleado);
    $stmt->bindParam(':apellidoPaterno', $apellidoPaterno);
    $stmt->bindParam(':apellidoMaterno', $apellidoMaterno);
    $stmt->bindParam(':emailEmpleado', $emailEmpleado);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':folio', $folio);
    $stmt->bindParam(':fecha_reporte', $fecha_reporte);
    $stmt->bindParam(':tipo_inc', $tipo_inc);
    $stmt->bindParam(':dep_rep', $dep_rep);
    $stmt->bindParam(':descrip_inc', $descrip_inc);
    $stmt->bindParam(':evidencia', $evidencia);
    $stmt->bindParam(':fecha_atencion', $fecha_atencion);
    $stmt->bindParam(':firma_de_conformidad', $firma_de_conformidad);

    $stmt->execute();

    $response['message'] = 'Datos insertados correctamente.';
} catch (PDOException $e) {
    $response['error'] = 'Error al insertar datos: ' . $e->getMessage();
} catch (Exception $e) {
    $response['error'] = 'Error al procesar la solicitud: ' . $e->getMessage();
}

// Imprimir el mensaje de respuesta para depuración
echo '<pre>';
print_r($_POST);
print_r($_FILES);
echo '</pre>';

// Recoger datos del formulario
$N_colaborador = $_POST['N_colaborador'] ?? '';
$departamento = $_POST['departamento'] ?? '';
$N_empleado = $_POST['N_empleado'] ?? '';
$Ape_paterno = $_POST['Ape_paterno'] ?? '';
$Ape_materno = $_POST['Ape_materno'] ?? '';
$correo = $_POST['correo'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$Folio = $_POST['folio'] ?? '';
$fecha_reporte = $_POST['fecha_reporte'] ?? '';
$tipo_inc = $_POST['tipo_inc'] ?? '';
$dep_rep = $_POST['dep_rep'] ?? '';
$descrip_inc = $_POST['descrip_inc'] ?? '';
$evidencia = $_POST['evidencia'] ?? '';
$fecha_atencion = $_POST['fecha_atencion'] ?? '';
$firma_de_conformidad = $_POST['firma_de_conformidad'] ?? '';

// Crear una instancia de Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// Crear una instancia de PHPMailer; pasando `true` habilita las excepciones
$mail = new PHPMailer(true);

// Contenido HTML para el PDF
$html = '
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            background-color: #ffffff;
            color: #000;
            padding: 10px 0;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .header img {
            max-width: 150px;
            display: block;
            margin: 0 auto;
        }
        .header h2 {
        color: #333333;
        font-size: 22px;
        margin: 0;
        }
        .header h1 {
            color: #ff0000;
            font-size: 22px;
            margin: 0;
        }
        .details {
            margin: 20px 0;
            background-color: #ffffff; /* Fondo blanco para las respuestas */
            padding: 20px;
            border-radius: 10px;
        }
        .details p {
            font-size: 16px;
            margin: 10px 0;
            display: flex;
            justify-content: space-between;
        }
        .details p strong {
            font-size: 16px;
        font-weight: bold;
        display: inline-block;
        width: 45%; /* Ajustado para estar más centrado */
        text-align: left;
        color: #626262;
        }
        .details p span {
            font-size: 16px;
        color: #666666;
        margin-left: 10px;
        width: 50%; /* Ajustado para estar más centrado */
        text-align: left; /* Alineación del texto */
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            padding: 10px 0;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <div class="details">
        <div class="header">
            <h1>Harinera de Oriente</h1>
            <h2>F-GES-08 Reporte de incidencias informáticas</h2>
        </div>
            <p><strong>Número de colaborador:</strong> <span>' . $N_colaborador . '</span></p>
            <p><strong>Departamento:</strong> <span>' . $departamento . '</span></p>
            <p><strong>Nombre del colaborador:</strong> <span>' . $N_empleado . '</span></p>
            <p><strong>Apellido paterno:</strong> <span>' . $Ape_paterno  . '</span></p>
            <p><strong>Apellido materno:</strong> <span>' . $Ape_materno  . '</span></p>
            <p><strong>Correo electrónico:</strong> <span>' . $correo . '</span></p>
            <p><strong>Número de contacto:</strong> <span>' . $telefono . '</span></p>
            <p><strong>Folio:</strong> <span>' . $Folio . '</span></p>
            <p><strong>Fecha de reporte:</strong> <span>' . $fecha_reporte . '</span></p>
            <p><strong>¿Qué tipo de incidencia reporta?:</strong> <span>' . $tipo_inc . '</span></p>
            <p><strong>¿En qué departamento o área de la organización se tiene esta incidencia?:</strong> <span>' . $dep_rep . '</span></p>
            <p><strong>Descripción de la incidencia:</strong> <span>' . $descrip_inc . '</span></p>
            <p><strong>Evidencia:</strong> <span>' . $evidencia. '</span></p>
            <p><strong>Fecha de atención:</strong> <span>' . $fecha_atencion. '</span></p>
            <p><strong>Firma de conformidad:</strong> <span>' . $firma_de_conformidad . '</span></p>
        </div>
        <div class="footer">
            <p>Atentamente, <br>Equipo de base4</p>
            <p>Este es un mensaje automatizado. Por favor, no respondas a este correo.</p>
        </div>
    </div>
</body>
</html>';

// Cargar el contenido HTML en Dompdf
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Obtener la salida del PDF como un string
$pdfOutput = $dompdf->output();

// Crear una instancia de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del servidor
    $mail->isSMTP();
    $mail->Host       = 'smtp.ionos.mx';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'servicios@correo.base4.mx';
    $mail->Password   = '0202ChubacaC';
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;

    // Destinatarios
    $mail->setFrom('servicios@correo.base4.mx', 'base4');
    $mail->addAddress($correo, $N_colaborador);

    // Agregar correos electrónicos adicionales de repIncidencias
    $repIncidenciasEmails = getRepIncidenciasEmails($conn);
    foreach ($repIncidenciasEmails as $email) {
        $mail->addAddress($email);
    }


    // Adjuntar el PDF
    $mail->addStringAttachment($pdfOutput, 'Reporte de incidencias informaticas.pdf');

    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'HO - Nuevo reporte de incidencia informatica - Folio#' .$Folio;

    // Adjuntar los archivos de evidencia al correo
    foreach ($evidenciaFiles as $file) {
        $mail->addAttachment($uploadDir . $file);
    }


    // Construir el cuerpo del mensaje HTML personalizado con estilos CSS
    $logoUrl = 'https://www.harineradeoriente.mx/wp-content/uploads/2023/09/1200-X-630.png'; // Ruta local al logo
    $message = '
    <html>
    <head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            background-color: #ffffff;
            color: #000;
            padding: 10px 0;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .header img {
            max-width: 150px;
            display: block;
            margin: 0 auto;
        }
        .header h1 {
            margin: 10px 0 0;
            font-size: 24px;
        }
        .details {
            margin: 20px 0;
            background-color: #ffffff; /* Fondo blanco para las respuestas */
            padding: 20px;
            border-radius: 10px;
        }
        .details p {
            font-size: 16px;
            margin: 10px 0;
            display: flex;
            justify-content: space-between;
        }
        .details p strong {
            font-size: 16px;
            font-weight: bold;
            display: inline-block;
            width: 45%; /* Ajustado para estar más centrado */
            text-align: left;
            color: #626262;
        }
        .details p span {
            font-size: 16px;
            color: #666666;
            margin-left: 10px;
            width: 50%; /* Ajustado para estar más centrado */
            text-align: left; /* Alineación del texto */
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            padding: 10px 0;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <div class="details">
        <div class="header">
            <img src="https://www.harineradeoriente.mx/wp-content/uploads/2023/09/1200-X-630.png" alt="Harina de Oriente">
            <h1>Reporte de incidencia informatica</h1>
            </div>
            <p><strong>Número de colaborador:</strong> <span>' . $N_colaborador . '</span></p>
            <p><strong>Departamento:</strong> <span>' . $departamento . '</span></p>
            <p><strong>Nombre del colaborador:</strong> <span>' . $N_empleado . '</span></p>
            <p><strong>Apellido paterno:</strong> <span>' . $Ape_paterno  . '</span></p>
            <p><strong>Apellido materno:</strong> <span>' . $Ape_materno  . '</span></p>
            <p><strong>Correo electrónico:</strong> <span>' . $correo . '</span></p>
            <p><strong>Número de contacto:</strong> <span>' . $telefono . '</span></p>
            <p><strong>Folio:</strong> <span>' . $Folio . '</span></p>
            <p><strong>Fecha de reporte:</strong> <span>' . $fecha_reporte . '</span></p>
            <p><strong>¿Qué tipo de incidencia reporta?:</strong> <span>' . $tipo_inc . '</span></p>
            <p><strong>¿En qué departamento o área de la organización se tiene esta incidencia?:</strong> <span>' . $dep_rep . '</span></p>
            <p><strong>Descripción de la incidencia:</strong> <span>' . $descrip_inc . '</span></p>
            <p><strong>Evidencia:</strong> <span>' . $evidencia. '</span></p>
            <p><strong>Fecha de atención:</strong> <span>' . $fecha_atencion. '</span></p>
            <p><strong>Firma de conformidad:</strong> <span>' . $firma_de_conformidad . '</span></p>
        </div>
        <div class="footer">
            <p>Atentamente, <br>Equipo de base4</p>
            <p>Este es un mensaje automatizado. Por favor, no respondas a este correo.</p>
        </div>
    </div>
</body>
</html>';

    $mail->Body = $message;

    // Enviar el correo
    $mail->send();
    echo 'Mensaje enviado correctamente';
} catch (Exception $e) {
    echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
}
?>
