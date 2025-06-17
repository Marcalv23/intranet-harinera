<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Importar las clases de PHPMailer y Dompdf al espacio de nombres global
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;
use Dompdf\Options;

require 'vendor/autoload.php';
require '../../../Models/Connection.php';


function getESColaboradoresEmails($conn) {
    $emails = [];
    try {
        $stmt = $conn->prepare("SELECT email FROM correosforms WHERE formName = :nombre");
        $nombre = 'ESColaboradores';
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

    // Recoger datos del formulario
    $N_colaborador = $_POST['N_colaborador'] ?? '';
    $departamento = $_POST['departamento'] ?? '';
    $N_empleado = $_POST['N_empleado'] ?? '';
    $Ape_paterno = $_POST['Ape_paterno'] ?? '';
    $Ape_materno = $_POST['Ape_materno'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $folio = $_POST['folio'] ?? '';
    $fecha_solicitud = $_POST['fecha_solicitud'] ?? '';
    $prioridad = $_POST['prioridad'] ?? '';
    $entrada_o_salida = $_POST['entrada_o_salida'] ?? '';
    $fecha_devolucion = $_POST['fecha_devolucion'] ?? '';
    $fines_utilizacion = $_POST['fines_utilizacion'] ?? '';
    $nombre_colab = $_POST['nombre_colab'] ?? '';
    $firma_de_responsable = $_POST['firma_de_responsable'] ?? 'Si';
    $nombre_aut_ho = $_POST['nombre_aut_ho'] ?? '';
    $correo_aut_ho = $_POST['correo_aut_ho'] ?? '';
    $firma_aut_ho = $_POST['firma_aut_ho'] ?? 'Si';
    $evidencia = $_POST['evidencia'] ?? '';

        // Obtener idDepto a partir del nombre del departamento
    $nombreDepartamento = $_POST['departamento'] ?? ''; // Asegúrate de que este campo esté presente en el formulario
    $stmtDepto = $conn->prepare("SELECT idDepto FROM departamento WHERE nombre = :departamento");
    $stmtDepto->bindParam(':departamento', $departamento);
    $stmtDepto->execute();
    $idDepartamento = $stmtDepto->fetchColumn();

    if (!$idDepartamento) {
        throw new Exception("Departamento '$departamento' no encontrado.");
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
    $query = "INSERT INTO escolaboradores (
        noEmpleado,
        idDepartamento,
        nombreEmpleado,
        apellidoPaterno,
        apellidoMaterno,
        emailEmpleado,
        telefono,
        folio,
        fecha_solicitud,
        propietario_equipo,
        entrada_salida,
        fecha_devolucion,
        motivo,
        evidencia,
        nombre_colaborador,
        aceptacion_responsabilidad,
        nombre_autorizador,
        correo_autorizador,
        firma_autorizador
    ) VALUES (
        :N_colaborador,
        :idDepartamento,
        :N_empleado,
        :Ape_paterno,
        :Ape_materno,
        :correo,
        :telefono,
        :folio,
        :fecha_solicitud,
        :prioridad,
        :entrada_o_salida,
        :fecha_devolucion,
        :fines_utilizacion,
        :evidencia,
        :nombre_colab,
        :firma_de_responsable,
        :nombre_aut_ho,
        :correo_aut_ho,
        :firma_aut_ho
    )";

    // Preparar la consulta
    $stmt = $conn->prepare($query);

    // Vincular parámetros
    $stmt->bindParam(':N_colaborador', $N_colaborador);
    $stmt->bindParam(':idDepartamento', $idDepartamento);
    $stmt->bindParam(':N_empleado', $N_empleado);
    $stmt->bindParam(':Ape_paterno', $Ape_paterno);
    $stmt->bindParam(':Ape_materno', $Ape_materno);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':folio', $folio);
    $stmt->bindParam(':fecha_solicitud', $fecha_solicitud);
    $stmt->bindParam(':prioridad', $prioridad);
    $stmt->bindParam(':entrada_o_salida', $entrada_o_salida);
    $stmt->bindParam(':fecha_devolucion', $fecha_devolucion);
    $stmt->bindParam(':fines_utilizacion', $fines_utilizacion);
    $stmt->bindParam(':evidencia', $evidencia);
    $stmt->bindParam(':nombre_colab', $nombre_colab);
    $stmt->bindParam(':firma_de_responsable', $firma_de_responsable);
    $stmt->bindParam(':nombre_aut_ho', $nombre_aut_ho);
    $stmt->bindParam(':correo_aut_ho', $correo_aut_ho);
    $stmt->bindParam(':firma_aut_ho', $firma_aut_ho);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el ID de la incidencia recién insertada
    $incidenciaId = $conn->lastInsertId();

    // Insertar en la tabla 'mercancias_servicios'
    if (isset($_POST['tipo_equipo']) && is_array($_POST['tipo_equipo'])) {
        foreach ($_POST['tipo_equipo'] as $index => $partida) {
            $cantidad = $_POST['marca'][$index] ?? '';
            $unidad = $_POST['modelo'][$index] ?? '';
            $descripcion = $_POST['numero_serie'][$index] ?? '';

            $stmt = $conn->prepare("INSERT INTO caracteristicasescolaboradores (
                ESColaboradores_id,
                tipo_equipo,
                marca,
                modelo,
                numero_serie
            ) VALUES (
                :ESColaboradores_id,
                :tipoEquipo,
                :marca,
                :modelo,
                :numeroSerie
            )");
            $stmt->bindParam(':ESColaboradores_id', $incidenciaId); // Asegúrate de usar la variable correcta
            $stmt->bindParam(':tipoEquipo', $partida);
            $stmt->bindParam(':marca', $cantidad);
            $stmt->bindParam(':modelo', $unidad);
            $stmt->bindParam(':numeroSerie', $descripcion);
            $stmt->execute();
        }
    }

    $response['message'] = 'Datos insertados correctamente.';
} catch (PDOException $e) {
    $response['error'] = 'Error al insertar datos: ' . $e->getMessage();
    echo '<pre>';
    echo "Error de PDO: " . $e->getMessage() . "\n";
    echo '</pre>';
} catch (Exception $e) {
    $response['error'] = 'Error al procesar la solicitud: ' . $e->getMessage();
    echo '<pre>';
    echo "Error general: " . $e->getMessage() . "\n";
    echo '</pre>';
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
$Ape_materno= $_POST['Ape_materno'] ?? '';
$correo = $_POST['correo'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$folio = $_POST['folio'] ?? '';
$fecha_solicitud = $_POST['fecha_solicitud'] ?? '';
$prioridad = $_POST['prioridad'] ?? '';
$entrada_o_salida = $_POST['entrada_o_salida'] ?? '';
$fecha_devolucion = $_POST['fecha_devolucion'] ?? '';
$fines_utilizacion = $_POST['fines_utilizacion'] ?? '';
$nombre_colab = $_POST['nombre_colab'] ?? '';
$firma_de_responsable = $_POST['firma_de_responsable'] ?? '';
$aceptacion = ' Me comprometo a asumir la responsabilidad del cuidado y uso, siguiendo las políticas y procedimientos establecidos por la empresa.';
$nombre_aut_ho = $_POST['nombre_aut_ho'] ?? '';
$correo_aut_ho = $_POST['correo_aut_ho'] ?? '';
$firma_aut_ho = $_POST['firma_aut_ho'] ?? '';
$evidencias = $_POST['evidencia'] ?? '';

// Recoger datos de la tabla dinámica
$tabla_dinamica_html = '';
if (isset($_POST['tipo_equipo'])) {
    $tabla_dinamica_html = '
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        padding: 8px; /* Menos espacio para las celdas */
        text-align: center; /* Centrando contenido de la tabla */
        }
        th, td {
            padding: 15px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2; /* Dark red background */
            color: black;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        td {
            border-bottom: 1px solid #e0e0e0;
        }
        tbody tr:last-child td {
            border-bottom: none;
        }
        caption {
            caption-side: top;
            font-size: 1.5em;
            margin: 10px;
            color: #d32f2f; /* Dark red text color */
        }
    </style>
    <table>
        <thead>
            <tr>
                <th>Tipo de equipo</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Número de serie</th>
            </tr>
        </thead>
        <tbody>';
    
    foreach ($_POST['tipo_equipo'] as $index => $tipoEquipo) {
        $marca = $_POST['marca'][$index] ?? '';
        $modelo = $_POST['modelo'][$index] ?? '';
        $numeroSerie = $_POST['numero_serie'][$index] ?? '';

        $tabla_dinamica_html .= "
        <tr>
            <td>$tipoEquipo</td>
            <td>$marca</td>
            <td>$modelo</td>
            <td>$numeroSerie</td>
        </tr>";
    }
    
    $tabla_dinamica_html .= '</tbody></table>';
}

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
    .logo {
        max-width: 150px;
        display: block;
        margin: 0 auto;
        margin-top: 20px;
    }
    .footer {
        background-color: #f8f9fa;
        padding: 10px;
        text-align: center;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
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
    p {
        font-size: 16px;
        color: #666666;
        margin: 10px 0;
        display: flex;
        justify-content: space-between;
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
    .content {
        margin-top: 20px;
        background-color: #ffffff; /* Fondo blanco para las respuestas */
        padding: 20px;
        border-radius: 10px;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        background-color: #ffffff;
    }
    table, th, td {
        border: 1px solid #e0e0e0; /* Light gray border for better visibility */
    }
    th, td {
        padding: 8px; /* Menos espacio para las celdas */
        text-align: center; /* Centrando contenido de la tabla */
    }
    th {
        background-color: #e0e0e0; /* Fondo gris para las etiquetas */
        color: #000000; /* Texto negro */
    }
    td {
        background-color: #ffffff; /* Fondo blanco para las respuestas */
        color: #000000; /* Texto negro */
    }
    tr:nth-child(even) {
        background-color: #f5f5f5; /* Fondo gris claro para las filas pares */
    }
    tr:hover {
        background-color: #f0f0f0; /* Fondo gris ligeramente más oscuro para el efecto hover */
    }
    caption {
        caption-side: top;
        font-size: 1.5em;
        margin: 10px;
        color: #d32f2f; /* Dark red text color */
    }
</style>
    </head>
    <body>
        <div class="container">
         <div class="content">
            <div class="header">
                <h1>Harinera de Oriente</h1>
                <h2>F-GES-04 Entrada/salida de equipo de cómputo (colaboradores) REV. 01</h2>
            </div>
            <p><strong>Número de colaborador:</strong> ' . $N_colaborador . '</p>
            <p><strong>Departamento:</strong> ' . $departamento . '</p>
            <p><strong>Nombre del colaborador:</strong> ' . $N_empleado . '</p>
            <p><strong>Apellido paterno:</strong> ' . $Ape_paterno  . '</p>
            <p><strong>Apellido materno:</strong> ' . $Ape_materno  . '</p>
            <p><strong>Correo electrónico:</strong> ' . $correo . '</p>
            <p><strong>Número de teléfono:</strong> ' . $telefono . '</p>
            <p><strong>Folio:</strong> ' . $folio . '</p>
            <p><strong>Fecha de solicitud:</strong> ' . $fecha_solicitud . '</p>
            <p><strong>Propietario del equipo:</strong> ' . $prioridad . '</p>
            <p><strong>¿Entrada o salida?:</strong> ' . $entrada_o_salida . '</p>
            <p><strong>Fecha de devolucion:</strong> ' . $fecha_devolucion . '</p>
            <p><strong>Motivo:</strong> ' . $fines_utilizacion. '</p>
            <p><strong>Características:</strong> ' . $tabla_dinamica_html. '</p>
            <p><strong>Evidencias:</strong> ' . $evidencias. '</p>
            <p><strong>Nombre del colaborador:</strong> ' . $nombre_colab. '</p>
            <p><strong>Firma de responsable:</strong> ' . $firma_de_responsable. '</p>
            <p><strong>Aceptación de responsabilidad:</strong> ' . $aceptacion. '</p>
            <p><strong>Nombre de quien autoriza:</strong> ' . $nombre_aut_ho. '</p>
            <p><strong>Correo electrónico de quien autoriza:</strong> ' . $correo_aut_ho. '</p>
            <p><strong>Firma de quien autoriza:</strong> ' . $firma_aut_ho. '</p>
            </div>
            <div class="footer">
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
    $mail->addAddress($correo, $N_empleado);

     // Agregar correos electrónicos adicionales de repIncidencias
     $ESColaboradoresEmails = getESColaboradoresEmails($conn);
     foreach ($ESColaboradoresEmails as $email) {
         $mail->addAddress($email);
     }

    // Adjuntar el PDF
    $mail->addStringAttachment($pdfOutput, 'Entrada/salida de equipo de cómputo (colaboradores).pdf');

    // Contenido del correo
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = 'HO - Nueva entrada/salida de equipo de cómputo (colaboradores) - Folio#' . $folio;

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
    .logo {
        max-width: 150px;
        display: block;
        margin: 0 auto;
        margin-top: 20px;
    }
    .footer {
        background-color: #f8f9fa;
        padding: 10px;
        text-align: center;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
        margin-top: 20px;
    }
    h1 {
        color: #ff0000;
        font-size: 22px;
        margin: 0;
    }
    p {
        font-size: 16px;
        color: #666666;
        margin: 10px 0;
        display: flex;
        justify-content: space-between;
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
    .content {
        margin-top: 20px;
        background-color: #ffffff; /* Fondo blanco para las respuestas */
        padding: 20px;
        border-radius: 10px;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        background-color: #ffffff;
    }
    table, th, td {
        border: 1px solid #e0e0e0; /* Light gray border for better visibility */
    }
    th, td {
        padding: 8px; /* Menos espacio para las celdas */
        text-align: center; /* Centrando contenido de la tabla */
    }
    th {
        background-color: #e0e0e0; /* Fondo gris para las etiquetas */
        color: #000000; /* Texto negro */
    }
    td {
        background-color: #ffffff; /* Fondo blanco para las respuestas */
        color: #000000; /* Texto negro */
    }
    tr:nth-child(even) {
        background-color: #f5f5f5; /* Fondo gris claro para las filas pares */
    }
    tr:hover {
        background-color: #f0f0f0; /* Fondo gris ligeramente más oscuro para el efecto hover */
    }
    caption {
        caption-side: top;
        font-size: 1.5em;
        margin: 10px;
        color: #d32f2f; /* Dark red text color */
    }
</style>
    </head>
    <body>
        <div class="container">
         <div class="content">
            <div class="header">
                <img src="' . $logoUrl . '" class="logo" alt="Logo">
                <h1>F-GES-04 Entrada/salida de equipo de cómputo (colaboradores) REV. 01</h1>
            </div>
            <p><strong>Número de colaborador:</strong> ' . $N_colaborador . '</p>
            <p><strong>Departamento:</strong> ' . $departamento . '</p>
            <p><strong>Nombre del colaborador:</strong> ' . $N_empleado . '</p>
            <p><strong>Apellido paterno:</strong> ' . $Ape_paterno  . '</p>
            <p><strong>Apellido materno:</strong> ' . $Ape_materno  . '</p>
            <p><strong>Correo electrónico:</strong> ' . $correo . '</p>
            <p><strong>Número de teléfono:</strong> ' . $telefono . '</p>
            <p><strong>Folio:</strong> ' . $folio . '</p>
            <p><strong>Fecha de solicitud:</strong> ' . $fecha_solicitud . '</p>
            <p><strong>Propietario del equipo:</strong> ' . $prioridad . '</p>
            <p><strong>¿Entrada o salida?:</strong> ' . $entrada_o_salida . '</p>
            <p><strong>Fecha de devolucion:</strong> ' . $fecha_devolucion . '</p>
            <p><strong>Motivo:</strong> ' . $fines_utilizacion. '</p>
            <p><strong>Características:</strong> ' . $tabla_dinamica_html. '</p>
            <p><strong>Evidencias:</strong> ' . $evidencias. '</p>
            <p><strong>Nombre del colaborador:</strong> ' . $nombre_colab. '</p>
            <p><strong>Firma de responsable:</strong> ' . $firma_de_responsable. '</p>
            <p><strong>Aceptación de responsabilidad:</strong> ' . $aceptacion. '</p>
            <p><strong>Nombre de quien autoriza:</strong> ' . $nombre_aut_ho. '</p>
            <p><strong>Correo electrónico de quien autoriza:</strong> ' . $correo_aut_ho. '</p>
            <p><strong>Firma de quien autoriza:</strong> ' . $firma_aut_ho. '</p>
            </div>
            <div class="footer">
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
