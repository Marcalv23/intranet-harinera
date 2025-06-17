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

function getvacanteLaboralEmails($conn) {
    $emails = [];
    try {
        $stmt = $conn->prepare("SELECT email FROM correosforms WHERE formName = :nombre");
        $nombre = 'vacanteLaboral';
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
    $evidenciaString = "File 1: Name = Marc A-TI_FR-DC-09 Formato Evaluación y Liberación de la Estadía Práctica (1).pdf, Size = 139852 bytes, Type = application/pdf";

    // Extraer solo el nombre del archivo usando una expresión regular
    preg_match('/Name\s*=\s*([^,]+)/', $evidenciaString, $matches);
    $nombreArchivo = trim($matches[1]);

    // Mostrar el nombre del archivo extraído para depuración
    echo '<pre>';
    echo "Nombre del archivo extraído: $nombreArchivo\n";
    echo '</pre>';

    $conn = Connection::connectionBD();

    // Recoger datos del formulario
    $puesto_postula = $_POST['puesto_postula'] ?? '';
    $evidencia = $_POST['cv'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $edad = $_POST['edad'] ?? '';
    $sexo = $_POST['sexo'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $colonia = $_POST['colonia'] ?? '';
    $ciudad = $_POST['ciudad'] ?? '';
    $estado = $_POST['estado'] ?? '';
    $codigo_postal = $_POST['codigo_postal'] ?? '';
    $institucion_academica = $_POST['institucion_academica'] ?? '';
    $grado_estudio = $_POST['grado_estudio'] ?? '';
    $nombre_carrera = $_POST['nombre_carrera'] ?? '';
    $experiencia_laboral = $_POST['experiencia_laboral'] ?? '';
    $exp_soli = $_POST['exp_soli'] ?? '';
    $tipo_licencia = $_POST['tipo_licencia'] ?? '';
    $pariente = $_POST['pariente'] ?? '';
    $nombre_pariente = $_POST['nombre_pariente'] ?? '';
    $constancia_documento = $_POST['constancia_documento'] ?? '';
    $nss_documento = $_POST['nss_documento'] ?? '';
    $curp_documento = $_POST['curp_documento'] ?? '';



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

            $allowed = ['pdf', 'docx'];

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


    // Mostrar datos de depuración
    echo '<pre>';
    echo "Datos del formulario:\n";
    print_r($_POST);
    echo "Archivos subidos:\n";
    print_r($_FILES);
    echo "Datos a insertar:\n";
    print_r([
        'puesto_postula' => $puesto_postula,
        'constancia_documento' => $constancia_documento,
        'nss_documento' => $nss_documento,
        'curp_documento' => $curp_documento,
        'nombre' => $nombre,
        'apellido' => $apellido,
        'edad' => $edad,
        'sexo' => $sexo,
        'correo' => $correo,
        'telefono' => $telefono,
        'direccion' => $direccion,
        'colonia' => $colonia,
        'ciudad' => $ciudad,
        'estado' => $estado,
        'codigo_postal' => $codigo_postal,
        'institucion_academica' => $institucion_academica,
        'grado_estudio' => $grado_estudio,
        'nombre_carrera' => $nombre_carrera,
        'experiencia_laboral' => $experiencia_laboral,
        'exp_soli' => $exp_soli,
        'tipo_licencia' => $tipo_licencia,
        'pariente' => $pariente,
        'nombre_pariente' => $nombre_pariente,
    ]);
    echo '</pre>';

    // Consulta de inserción
    $query = "INSERT INTO postulaciones (
        puesto_postula,
        cv_documento,
        constancia_documento,
        nss_documento,
        curp_documento,
        nombre,
        apellido,
        edad,
        sexo,
        correo,
        telefono,
        direccion,
        colonia,
        ciudad,
        estado,
        codigo_postal,
        institucion_academica,
        grado_estudio,
        nombre_carrera,
        experiencia_laboral,
        exp_soli,
        tipo_licencia,
        pariente,
        nombre_pariente,
        documentacion
    ) VALUES (
        :puesto_postula,
        :evidencia,
        :constancia_documento,
        :nss_documento,
        :curp_documento,
        :nombre,
        :apellido,
        :edad,
        :sexo,
        :correo,
        :telefono,
        :direccion,
        :colonia,
        :ciudad,
        :estado,
        :codigo_postal,
        :institucion_academica,
        :grado_estudio,
        :nombre_carrera,
        :experiencia_laboral,
        :exp_soli,
        :tipo_licencia,
        :pariente,
        :nombre_pariente,
        :documentacion
    )";

    // Preparar la consulta
    $stmt = $conn->prepare($query);

    // Vincular parámetros
    $stmt->bindParam(':puesto_postula', $puesto_postula);
    $stmt->bindParam(':evidencia', $evidencia);
    $stmt->bindParam(':constancia_documento', $constancia_documento);
    $stmt->bindParam(':nss_documento', $nss_documento);
    $stmt->bindParam(':curp_documento', $curp_documento);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':edad', $edad);
    $stmt->bindParam(':sexo', $sexo);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':direccion', $direccion);
    $stmt->bindParam(':colonia', $colonia);
    $stmt->bindParam(':ciudad', $ciudad);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':codigo_postal', $codigo_postal);
    $stmt->bindParam(':institucion_academica', $institucion_academica);
    $stmt->bindParam(':grado_estudio', $grado_estudio);
    $stmt->bindParam(':nombre_carrera', $nombre_carrera);
    $stmt->bindParam(':experiencia_laboral', $experiencia_laboral);
    $stmt->bindParam(':exp_soli', $exp_soli);
    $stmt->bindParam(':tipo_licencia', $tipo_licencia);
    $stmt->bindParam(':pariente', $pariente);
    $stmt->bindParam(':nombre_pariente', $nombre_pariente);
    $stmt->bindParam(':documentacion', $evidencia);

    // Ejecutar la consulta
    $stmt->execute();

    echo 'Datos insertados correctamente.';
} catch (PDOException $e) {
    echo 'Error al insertar datos: ' . $e->getMessage();
} catch (Exception $e) {
    echo 'Error al procesar la solicitud: ' . $e->getMessage();
}

// Verifica el mensaje de respuesta para depuración
echo '<pre>';
print_r($_POST);
print_r($_FILES);
echo '</pre>';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los datos del formulario
    $cv_documento = isset($_POST['cv_documento']) ? $_POST['cv_documento'] : '';
    $constancia_documento = isset($_POST['constancia_documento']) ? $_POST['constancia_documento'] : '';
    $nss_documento = isset($_POST['nss_documento']) ? $_POST['nss_documento'] : '';
    $curp_documento = isset($_POST['curp_documento']) ? $_POST['curp_documento'] : '';

    $puesto_postula = isset($_POST['puesto_postula']) ? $_POST['puesto_postula'] : '';
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
    $edad = isset($_POST['edad']) ? $_POST['edad'] : '';
    $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : '';
    $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
    $colonia = isset($_POST['colonia']) ? $_POST['colonia'] : '';
    $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : '';
    $estado = isset($_POST['estado']) ? $_POST['estado'] : '';
    $codigo_postal = isset($_POST['codigo_postal']) ? $_POST['codigo_postal'] : '';
    $institucion_academica = isset($_POST['institucion_academica']) ? $_POST['institucion_academica'] : '';
    $grado_estudio = isset($_POST['grado_estudio']) ? $_POST['grado_estudio'] : '';
    $nombre_carrera = isset($_POST['nombre_carrera']) ? $_POST['nombre_carrera'] : '';
    $experiencia_laboral = isset($_POST['experiencia_laboral']) ? $_POST['experiencia_laboral'] : '';
    $exp_soli = isset($_POST['exp_soli']) ? $_POST['exp_soli'] : ''; // Make sure this variable is set
    $tipo_licencia = isset($_POST['tipo_licencia']) ? $_POST['tipo_licencia'] : '';
    $pariente = isset($_POST['pariente']) ? $_POST['pariente'] : '';
    $nombre_pariente = isset($_POST['nombre_pariente']) ? $_POST['nombre_pariente'] : '';

    // Crear una instancia de Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);

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
.details {
    margin-top: 20px;
    background-color: #ffffff; /* Fondo blanco para las respuestas */
    padding: 20px;
    border-radius: 10px;
}
.details p {
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
.content a {
    color: #666666; /* Cambia el color de los enlaces */
    text-decoration: none; /* Elimina el subrayado */
}
.content a:hover {
    text-decoration: underline; /* Subrayado al pasar el mouse */
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
    <div class="container">
        
        <div class="details">
        <div class="header">
            <h1>Harinera de Oriente</h1>

            <h2>Postulación a vacante laboral</h2>
        </div>
            <p><strong>Puesto al que postula:</strong> <span>' . $puesto_postula . '</span></p>
            <p><strong>Nombre completo:</strong> <span>' . $nombre . '</span></p>
            <p><strong>Apellido:</strong> <span>' . $apellido . '</span></p>
            <p><strong>Edad:</strong> <span>' . $edad  . '</span></p>
            <p><strong>Sexo:</strong> <span>' . $sexo   . '</span></p>
            <p><strong>Correo electrónico:</strong> <span>' . $correo . '</span></p>
            <p><strong>Número de contacto:</strong> <span>' . $telefono . '</span></p>
            <p><strong>Dirección:</strong> <span>' . $direccion. '</span></p>
            <p><strong>Calle y número:</strong> <span>' . $colonia . '</span></p>
            <p><strong>Ciudad:</strong> <span>' . $ciudad. '</span></p>
            <p><strong>Estado / Provincia:</strong> <span>' . $estado . '</span></p>
            <p><strong>Código postal:</strong> <span>' .  $codigo_postal. '</span></p>
            <p><strong>Institución académica de donde proviene:</strong> <span>' . $institucion_academica. '</span></p>
            <p><strong>Grado de estudio:</strong> <span>' .$grado_estudio . '</span></p>
            <p><strong>Nombre de la carrera:</strong> <span>' . $nombre_carrera . '</span></p>
            <p><strong>Experiencia laboral:</strong> <span>' .$experiencia_laboral  . '</span></p>
            <p><strong>Experiencia en el puesto solicitado:</strong> <span>' . $exp_soli . '</span></p>
            <p><strong>Documentación con la que cuenta:</strong> <span>' . $cv_documento . '</span></p>
            <p><strong>Constancia:</strong> <span>' . $constancia_documento . '</span></p>
            <p><strong>NSS:</strong> <span>' . $nss_documento . '</span></p>
            <p><strong>CURP:</strong> <span>' . $curp_documento . '</span></p>
            <p><strong>Tipo de licencia vigente:</strong> <span>' . $tipo_licencia  . '</span></p>
            <p><strong>¿Algún pariente o conocido trabaja en esta empresa?:</strong> <span>' . $pariente . '</span></p>
            <p><strong>¿Cuál es su nombre y parentesco?:</strong> <span>' . $nombre_pariente  . '</span></p>
        </div>
        <div class="footer">
            <p>Atentamente,
            Equipo de base4.</p>
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
        $mail->addAddress($correo, 'Vacante laboral harinera de oriente');

        // Agregar correos electrónicos adicionales de repIncidencias
        $ESColaboradoresEmails = getvacanteLaboralEmails($conn);
        foreach ($ESColaboradoresEmails as $email) {
            $mail->addAddress($email);
        }

        // Adjuntar el PDF
        $mail->addStringAttachment($pdfOutput, 'Postulación a vacante laboral.pdf');

        // Contenido del correo
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Postulación a vacante laboral';

        // Adjuntar los archivos de evidencia al correo
    foreach ($evidenciaFiles as $file) {
        $mail->addAttachment($uploadDir . $file);
    }

        // Construir el cuerpo del mensaje HTML
        $bodyHtml = '
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
.details {
    margin-top: 20px;
    background-color: #ffffff; /* Fondo blanco para las respuestas */
    padding: 20px;
    border-radius: 10px;
}
.details p {
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
.content a {
    color: #666666; /* Cambia el color de los enlaces */
    text-decoration: none; /* Elimina el subrayado */
}
.content a:hover {
    text-decoration: underline; /* Subrayado al pasar el mouse */
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
    <div class="container">
        
        <div class="details">
        <div class="header">
            <img src="https://www.harineradeoriente.mx/wp-content/uploads/2023/09/1200-X-630.png" alt="Harinera de Oriente">
            <h1>Postulación a vacante laboral</h1>
        </div>
            <p><strong>Puesto al que postula:</strong> <span>' . $puesto_postula . '</span></p>
            <p><strong>Nombre completo:</strong> <span>' . $nombre . '</span></p>
            <p><strong>Apellido:</strong> <span>' . $apellido . '</span></p>
            <p><strong>Edad:</strong> <span>' . $edad  . '</span></p>
            <p><strong>Sexo:</strong> <span>' . $sexo   . '</span></p>
            <p><strong>Correo electrónico:</strong> <span>' . $correo . '</span></p>
            <p><strong>Número de contacto:</strong> <span>' . $telefono . '</span></p>
            <p><strong>Dirección:</strong> <span>' . $direccion. '</span></p>
            <p><strong>Calle y número:</strong> <span>' . $colonia . '</span></p>
            <p><strong>Ciudad:</strong> <span>' . $ciudad. '</span></p>
            <p><strong>Estado / Provincia:</strong> <span>' . $estado . '</span></p>
            <p><strong>Código postal:</strong> <span>' .  $codigo_postal. '</span></p>
            <p><strong>Institución académica de donde proviene:</strong> <span>' . $institucion_academica. '</span></p>
            <p><strong>Grado de estudio:</strong> <span>' .$grado_estudio . '</span></p>
            <p><strong>Nombre de la carrera:</strong> <span>' . $nombre_carrera . '</span></p>
            <p><strong>Experiencia laboral:</strong> <span>' .$experiencia_laboral  . '</span></p>
            <p><strong>Experiencia en el puesto solicitado:</strong> <span>' . $exp_soli . '</span></p>
            <p><strong>Documentación con la que cuenta:</strong> <span>' . $cv_documento . '</span></p>
            <p><strong>Constancia:</strong> <span>' . $constancia_documento . '</span></p>
            <p><strong>NSS:</strong> <span>' . $nss_documento . '</span></p>
            <p><strong>CURP:</strong> <span>' . $curp_documento . '</span></p>
            <p><strong>Tipo de licencia vigente:</strong> <span>' . $tipo_licencia  . '</span></p>
            <p><strong>¿Algún pariente o conocido trabaja en esta empresa?:</strong> <span>' . $pariente . '</span></p>
            <p><strong>¿Cuál es su nombre y parentesco?:</strong> <span>' . $nombre_pariente  . '</span></p>
        </div>
        <div class="footer">
            <p>Atentamente,
            Equipo de base4.</p>
            <p>Este es un mensaje automatizado. Por favor, no respondas a este correo.</p>
        </div>
    </div>
</body>
</html>';

        // Asignar el cuerpo del correo
        $mail->Body = $bodyHtml;

        // Enviar el correo
        $mail->send();
        echo 'Correo enviado correctamente';
    } catch (Exception $e) {
        echo "Hubo un error al enviar el correo: {$mail->ErrorInfo}";
    }
}
?>
