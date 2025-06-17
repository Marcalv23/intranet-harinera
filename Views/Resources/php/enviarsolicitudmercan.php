<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../../Models/Connection.php';

function getRepIncidenciasEmails($conn) {
    $emails = [];
    try {
        $stmt = $conn->prepare("SELECT email FROM correosforms WHERE formName = :nombre");
        $nombre = 'SolicitudMercancia';
        $stmt->bindParam(':nombre', $nombre);
        $stmt->execute();
        $emails = $stmt->fetchAll(PDO::FETCH_COLUMN);
    } catch (PDOException $e) {
        echo "Error al obtener correos electrónicos: " . $e->getMessage();
    }
    return $emails;
}

try {
    $conn = Connection::connectionBD();

    // Datos del formulario con valores predeterminados para campos vacíos
    $noEmpleado = $_POST['N_colaborador'] ?? '';
    $idDepartamento = $_POST['departamento'] ?? '';
    $nombreEmpleado = $_POST['N_empleado'] ?? '';
    $apellidoPaterno = $_POST['Ape_paterno'] ?? '';
    $apellidoMaterno = $_POST['Ape_materno'] ?? '';
    $emailEmpleado = $_POST['correo'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $folio = $_POST['folio'] ?? '';
    $Prioridad = $_POST['Prioridad'] ?? '';
    $gestiona = $_POST['gestiona'] ?? '';
    $solicitando = $_POST['solicitando'] ?? '';
    $fecha_pedido = $_POST['fecha_pedido'] ?? '';
    $fecha_entrega = $_POST['fecha_entrega'] ?? '';
    $fines_utilizacion = $_POST['fines_utilizacion'] ?? '';
    $nombre_solicitud = $_POST['nombre_solicitud'] ?? '';
    $firma_solicitud = $_POST['firma_solicitud'] ?? '';
    $nombre_jefe = $_POST['nombre_jefe'] ?? '';
    $correo_jefe = $_POST['correo_jefe'] ?? '';
    $firma_jefe_recibe = $_POST['firma_jefe_recibe'] ?? '';
    $nombre_recibe = $_POST['nombre_recibe'] ?? '';
    $firma_recibe = $_POST['firma_recibe'] ?? '';

    // Insertar en la tabla 'soliMercaServi'
    $stmt = $conn->prepare("INSERT INTO soliMercaServi 
        (noEmpleado, idDepartamento, nombreEmpleado, apellidoPaterno, apellidoMaterno, emailEmpleado, telefono, folio, Prioridad, gestiona, solicitando, fecha_pedido, fecha_entrega, fines_utilizacion, nombre_solicitud, firma_solicitud, nombre_jefe, correo_jefe, nombre_recibe, firma_recibe, firma_jefe_recibe) 
        VALUES 
        (:noEmpleado, :idDepartamento, :nombreEmpleado, :apellidoPaterno, :apellidoMaterno, :emailEmpleado, :telefono, :folio, :Prioridad, :gestiona, :solicitando, :fecha_pedido, :fecha_entrega, :fines_utilizacion, :nombre_solicitud, :firma_solicitud, :nombre_jefe, :correo_jefe, :nombre_recibe, :firma_recibe, :firma_jefe_recibe)");

    // Vincular parámetros
    $stmt->bindParam(':noEmpleado', $noEmpleado);
    $stmt->bindParam(':idDepartamento', $idDepartamento);
    $stmt->bindParam(':nombreEmpleado', $nombreEmpleado);
    $stmt->bindParam(':apellidoPaterno', $apellidoPaterno);
    $stmt->bindParam(':apellidoMaterno', $apellidoMaterno);
    $stmt->bindParam(':emailEmpleado', $emailEmpleado);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':folio', $folio);
    $stmt->bindParam(':Prioridad', $Prioridad);
    $stmt->bindParam(':gestiona', $gestiona);
    $stmt->bindParam(':solicitando', $solicitando);
    $stmt->bindParam(':fecha_pedido', $fecha_pedido);
    $stmt->bindParam(':fecha_entrega', $fecha_entrega);
    $stmt->bindParam(':fines_utilizacion', $fines_utilizacion);
    $stmt->bindParam(':nombre_solicitud', $nombre_solicitud);
    $stmt->bindParam(':firma_solicitud', $firma_solicitud);
    $stmt->bindParam(':nombre_jefe', $nombre_jefe);
    $stmt->bindParam(':correo_jefe', $correo_jefe);
    $stmt->bindParam(':nombre_recibe', $nombre_recibe);
    $stmt->bindParam(':firma_recibe', $firma_recibe);
    $stmt->bindParam(':firma_jefe_recibe', $firma_jefe_recibe);

    $stmt->execute();

    // Obtener el ID de la última inserción
    $soliMercaServi_id = $conn->lastInsertId();

    // Insertar en la tabla 'mercancias_servicios'
    if (isset($_POST['partida']) && is_array($_POST['partida'])) {
        foreach ($_POST['partida'] as $index => $partida) {
            $cantidad = $_POST['cantidad'][$index] ?? '';
            $unidad = $_POST['unidad'][$index] ?? '';
            $descripcion = $_POST['descripcion'][$index] ?? '';

            $stmt = $conn->prepare("INSERT INTO mercancias_servicios (soliMercaServi_id, partida, cantidad, unidad, descripcion) VALUES (:soliMercaServi_id, :partida, :cantidad, :unidad, :descripcion)");
            $stmt->bindParam(':soliMercaServi_id', $soliMercaServi_id);
            $stmt->bindParam(':partida', $partida);
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt->bindParam(':unidad', $unidad);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->execute();
        }
    }

    $response['message'] = 'Datos insertados correctamente.';
} catch (PDOException $e) {
    $response['error'] = 'Error al insertar datos: ' . $e->getMessage();
} catch (Exception $e) {
    $response['error'] = 'Error al procesar la solicitud: ' . $e->getMessage();
}

// Imprimir respuesta en formato JSON
echo json_encode($response);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;
use Dompdf\Options;

require 'vendor/autoload.php';

try {
    // Recoger datos del formulario
    $N_colaborador = $_POST['N_colaborador'] ?? '';
    $departamento = $_POST['departamento'] ?? '';
    $N_empleado = $_POST['N_empleado'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $Folio = $_POST['folio'] ?? '';
    $Prioridad = $_POST['Prioridad'] ?? '';
    $gestiona = $_POST['gestiona'] ?? '';
    $solicitando = $_POST['solicitando'] ?? '';
    $fecha_pedido = $_POST['fecha_pedido'] ?? '';
    $fecha_entrega = $_POST['fecha_entrega'] ?? '';
    $fines_utilizacion = $_POST['fines_utilizacion'] ?? '';
    $nombre_solicitud = $_POST['nombre_solicitud'] ?? '';
    $firma_solicitud = $_POST['firma_solicitud'] ?? '';
    $nombre_jefe = $_POST['nombre_jefe'] ?? '';
    $correo_jefe = $_POST['correo_jefe'] ?? '';
    $firma_jefe_recibe = $_POST['firma_jefe_recibe'] ?? '';
    $nombre_recibe = $_POST['nombre_recibe'] ?? '';
    $firma_recibe = $_POST['firma_recibe'] ?? '';

    // Crear una instancia de Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);

    // Crear una instancia de PHPMailer; pasando `true` habilita las excepciones
    $mail = new PHPMailer(true);

    // Configuración del servidor SMTP
    $mail->isSMTP(); // Enviar usando SMTP
    $mail->Host       = 'smtp.ionos.mx'; // Servidor SMTP
    $mail->SMTPAuth   = true; // Habilitar autenticación SMTP
    $mail->Username   = 'servicios@correo.base4.mx'; // Usuario SMTP
    $mail->Password   = '0202ChubacaC'; // Contraseña SMTP (debe almacenarse de forma segura)
    $mail->SMTPSecure = 'ssl'; // Habilitar cifrado SSL
    $mail->Port       = 465; // Puerto TCP para conectar

    // Destinatario del correo
    $mail->setFrom('servicios@correo.base4.mx', 'base4');
    $mail->addAddress($correo, $N_colaborador); // Agregar destinatario
    $mail->addAddress($correo_jefe, $nombre_jefe);

    // Agregar correos electrónicos adicionales de repIncidencias
    $repIncidenciasEmails = getRepIncidenciasEmails($conn);
    foreach ($repIncidenciasEmails as $email) {
        $mail->addAddress($email);
    }
    
// Estilos y contenido del correo
$emailStyles = "
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        padding: 0;
        margin: 0;
    }
    .container {
        max-width: 800px; /* Hacer el contenedor más amplio */
        margin: 0 auto;
        padding: 30px;
        background-color: #f7f4f4; /* Color de fondo */
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }
    .header {
        background-color: #ffffff;
        color: #ffffff;
        padding: 10px;
        text-align: center;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    .header img {
        max-width: 150px;
        display: block;
        margin: 0 auto;
        margin-top: 20px;
    }
    .header h1 {
        color: #333333;
        font-size: 22px;
        margin: 0;
    }
    .content {
        margin-top: 20px;
        background-color: #ffffff; /* Fondo blanco para las respuestas */
        padding: 20px;
        border-radius: 10px;
    }
    .content p {
        margin: 10px 0;
        display: flex;
        justify-content: space-between;
    }
    .content p strong {
        font-size: 16px;
        font-weight: bold;
        display: inline-block;
        width: 45%; /* Ajustado para estar más centrado */
        text-align: left;
        color: #626262;
    }
    .content p span {
        font-size: 16px;
        color: #666666;
        margin-left: 10px;
        width: 50%; /* Ajustado para estar más centrado */
        text-align: left; /* Alineación del texto */
    }
    .content a {
        color: #666666; /* Cambia el color de los enlaces */
        text-decoration: none; /* Elimina el subrayado */
    }
    .content a:hover {
        text-decoration: underline; /* Subrayado al pasar el mouse */
    }
    .content table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    .content table, th, td {
        border: 1px solid #ccc;
        padding: 8px; /* Menos espacio para las celdas */
        text-align: center; /* Centrando contenido de la tabla */
    }
    .content th {
        background-color: #f2f2f2;
    }
    .content th.partida, .content td.partida {
        width: 10%; 
    }
    .content th.cantidad, .content td.cantidad {
        width: 10%; 
    }
    .content th.unidad, .content td.unidad {
        width: 10%; 
    }
    .content hr {
        border: 1px solid #ccc;
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .footer {
        background-color: #f8f9fa;
        padding: 10px;
        text-align: center;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
        margin-top: 20px;
    }
</style>
";

$emailContent = "
<html>
<head>
<title>Solicitud de mercancía o servicio</title>
$emailStyles
</head>
<body>
<div class='container'>
    
    <div class='content'>
    <div class='header'>
        <img src='https://www.harineradeoriente.mx/wp-content/uploads/2023/09/1200-X-630.png' alt='Logo de la Empresa'>
        <h1>Solicitud de mercancía o servicio</h1>
    </div>
        <p><strong>Número de colaborador:</strong> <span>$N_colaborador</span></p>
        <p><strong>Departamento:</strong> <span>$departamento</span></p>
        <p><strong>Nombre de colaborador:</strong> <span>$N_empleado</span></p>
        <p><strong>Correo electrónico:</strong> <span>$correo</span></p>
        <p><strong>Número de teléfono:</strong> <span>$telefono</span></p>
        <hr>
        <p><strong>Folio:</strong> <span>$Folio</span></p>
        <p><strong>Prioridad de atención:</strong> <span>$Prioridad</span></p>
        <p><strong>Departamento que gestionará la compra:</strong> <span>$gestiona</span></p>
        <p><strong>Solicitando:</strong> <span>$solicitando</span></p>
        <p><strong>Fecha de pedido:</strong> <span>$fecha_pedido</span></p>
        <p><strong>Fecha de entrega:</strong> <span>$fecha_entrega</span></p>
        <hr>
        <p><strong>Mercancías y/o Servicios:</strong></p>
        <table>
            <thead>
                <tr>
                    <th class='partida'>Partida</th>
                    <th class='cantidad'>Cantidad</th>
                    <th class='unidad'>Unidad</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>";

if (!empty($_POST['partida'])) {
    foreach ($_POST['partida'] as $index => $partida) {
        $cantidad = $_POST['cantidad'][$index] ?? '';
        $unidad = $_POST['unidad'][$index] ?? '';
        $descripcion = $_POST['descripcion'][$index] ?? '';

        $emailContent .= "
                <tr>
                    <td class='partida'>$partida</td>
                    <td class='cantidad'>$cantidad</td>
                    <td class='unidad'>$unidad</td>
                    <td>$descripcion</td>
                </tr>";
    }
}

$emailContent .= "
            </tbody>
        </table>
        <hr>
        <p><strong>Fines de utilización:</strong><br><span>$fines_utilizacion</span></p>
        <hr>
        <p><strong>Nombre de la persona que hace la solicitud:</strong> <span>$nombre_solicitud</span></p>
        <p><strong>Firma de la persona que hace la solicitud:</strong><br><span>$firma_solicitud</span></p>
        <hr>
        <p><strong>Nombre del Jefe inmediato:</strong> <span>$nombre_jefe</span></p>
        <p><strong>Correo electrónico del Jefe inmediato:</strong> <span>$correo_jefe</span></p>
        <p><strong>Firma del Jefe inmediato de la persona que hace la solicitud:</strong> <span>$firma_jefe_recibe</span></p>
        <hr>
        <p><strong>Nombre de la persona que recibe la mercancía:</strong> <span>$nombre_recibe</span></p>
        <p><strong>Firma de la persona que recibe la mercancía:</strong> <span>$firma_recibe</span></p>
    </div>
    <div class='footer'>
        <p>Atentamente, <br>Equipo de base4</p>
    </div>
</div>
</body>
</html>
";

// Configurar PHPMailer
$mail->isHTML(true); // Formato HTML
$mail->CharSet = 'UTF-8';
$mail->Subject = 'HO - Nueva solicitud de mercancía/servicio - Folio#' . $Folio;
$mail->Body    = $emailContent;
$mail->AltBody = strip_tags($emailContent); // Texto plano para clientes de correo que no soportan HTML

$pdfContent = "
<html>
<head>
<title>Solicitud de mercancía o servicio</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        padding: 0;
        margin: 0;
    }
    .container {
        max-width: 800px; /* Hacer el contenedor más amplio */
        margin: 0 auto;
        padding: 30px;
        background-color: #f7f4f4; /* Color de fondo */
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }
    .header {
        background-color: #ffffff;
        color: #ffffff;
        padding: 10px;
        text-align: center;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    .header img {
        max-width: 150px;
        display: block;
        margin: 0 auto;
        margin-top: 20px;
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
    .content {
        margin-top: 20px;
        background-color: #ffffff; /* Fondo blanco para las respuestas */
        padding: 20px;
        border-radius: 10px;
    }
    .content p {
        margin: 10px 0;
        display: flex;
        justify-content: space-between;
    }
    .content p strong {
        font-size: 16px;
        font-weight: bold;
        display: inline-block;
        width: 45%; /* Ajustado para estar más centrado */
        text-align: left;
        color: #626262;
    }
    .content p span {
        font-size: 16px;
        color: #666666;
        margin-left: 10px;
        width: 50%; /* Ajustado para estar más centrado */
        text-align: left; /* Alineación del texto */
    }
    .content a {
        color: #666666; /* Cambia el color de los enlaces */
        text-decoration: none; /* Elimina el subrayado */
    }
    .content a:hover {
        text-decoration: underline; /* Subrayado al pasar el mouse */
    }
    .content table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    .content table, th, td {
        border: 1px solid #ccc;
        padding: 8px; /* Menos espacio para las celdas */
        text-align: center; /* Centrando contenido de la tabla */
    }
    .content th {
        background-color: #f2f2f2;
    }
    .content th.partida, .content td.partida {
        width: 10%; 
    }
    .content th.cantidad, .content td.cantidad {
        width: 10%; 
    }
    .content th.unidad, .content td.unidad {
        width: 10%; 
    }
    .content hr {
        border: 1px solid #ccc;
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .footer {
        background-color: #f8f9fa;
        padding: 10px;
        text-align: center;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
        margin-top: 20px;
    }
</style>
</head>
<body>
<div class='container'>
    
    <div class='content'>
    <div class='header'>
        <h1>Harinera de Oriente</h1>
        <img src='' alt='Logo de la Empresa'>
        <h2>F-CMP-01 Solicitud de mercancía o servicio Rev. 02</h2>
    </div>
        <p><strong>Número de colaborador:</strong> <span>$N_colaborador</span></p>
        <p><strong>Departamento:</strong> <span>$departamento</span></p>
        <p><strong>Nombre de colaborador:</strong> <span>$N_empleado</span></p>
        <p><strong>Correo electrónico:</strong> <span>$correo</span></p>
        <p><strong>Número de teléfono:</strong> <span>$telefono</span></p>
        <hr>
        <p><strong>Folio:</strong> <span>$Folio</span></p>
        <p><strong>Prioridad de atención:</strong> <span>$Prioridad</span></p>
        <p><strong>Departamento que gestionará la compra:</strong> <span>$gestiona</span></p>
        <p><strong>Solicitando:</strong> <span>$solicitando</span></p>
        <p><strong>Fecha de pedido:</strong> <span>$fecha_pedido</span></p>
        <p><strong>Fecha de entrega:</strong> <span>$fecha_entrega</span></p>
        <hr>
        <p><strong>Mercancías y/o Servicios:</strong></p>
        <table>
            <thead>
                <tr>
                    <th class='partida'>Partida</th>
                    <th class='cantidad'>Cantidad</th>
                    <th class='unidad'>Unidad</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>";

if (!empty($_POST['partida'])) {
    foreach ($_POST['partida'] as $index => $partida) {
        $cantidad = $_POST['cantidad'][$index] ?? '';
        $unidad = $_POST['unidad'][$index] ?? '';
        $descripcion = $_POST['descripcion'][$index] ?? '';

        $pdfContent .= "
                <tr>
                    <td class='partida'>$partida</td>
                    <td class='cantidad'>$cantidad</td>
                    <td class='unidad'>$unidad</td>
                    <td>$descripcion</td>
                </tr>";
    }
}

$pdfContent .= "
            </tbody>
        </table>
        <hr>
        <p><strong>Fines de utilización:</strong><br><span>$fines_utilizacion</span></p>
        <hr>
        <p><strong>Nombre de la persona que hace la solicitud:</strong> <span>$nombre_solicitud</span></p>
        <p><strong>Firma de la persona que hace la solicitud:</strong><br><span>$firma_solicitud</span></p>
        <hr>
        <p><strong>Nombre del Jefe inmediato:</strong> <span>$nombre_jefe</span></p>
        <p><strong>Correo electrónico del Jefe inmediato:</strong> <span>$correo_jefe</span></p>
        <p><strong>Firma del Jefe inmediato de la persona que hace la solicitud:</strong> <span>$firma_jefe_recibe</span></p>
        <hr>
        <p><strong>Nombre de la persona que recibe la mercancía:</strong> <span>$nombre_recibe</span></p>
        <p><strong>Firma de la persona que recibe la mercancía:</strong> <span>$firma_recibe</span></p>
    </div>
    <div class='footer'>
        <p>Atentamente, <br>Equipo de base4</p>
    </div>
</div>
</body>
</html>
";

    // Generación del PDF
    $dompdf->loadHtml($pdfContent);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    // Guardar el PDF en un archivo
    $pdfOutput = $dompdf->output();
    file_put_contents('solicitud.pdf', $pdfOutput);

    // Adjuntar el PDF al correo
    $mail->addAttachment('solicitud.pdf');

    // Enviar el correo
    $mail->send();
    echo 'El correo ha sido enviado y el PDF ha sido generado correctamente.';
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}
?>