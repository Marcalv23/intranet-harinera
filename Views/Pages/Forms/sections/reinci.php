<?php
// Habilitar la visualización de errores para la depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'Models/Connection.php'; // Ajusta la ruta según tu estructura de carpetas

// Obtener la instancia de PDO
$pdo = Connection::connectionBD();

// Obtener el ID de la consulta
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$data = [];
$evidenciaArray = [];

if ($id > 0) {
    // Consulta para obtener detalles basados en el ID, incluyendo el nombre del departamento
    try {
        $stmt = $pdo->prepare("
            SELECT r.*, d.nombre AS nombreDepartamento
            FROM reinci r
            LEFT JOIN departamento d ON r.idDepartamento = d.idDepto
            WHERE r.id = :id
        ");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Convertir el campo evidencia en un array
        $evidenciaArray = !empty($data['evidencia']) ? explode(',', $data['evidencia']) : [];
    } catch (PDOException $e) {
        die("Error en la consulta: " . $e->getMessage());
    }
}

// Manejar el envío del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $tipoIncidencia = $_POST['tipo_inc'] ?? '';
    $depRep = $_POST['dep_rep'] ?? '';
    $descripInc = $_POST['descrip_inc'] ?? '';
    $fechaAtencion = $_POST['fecha_atencion'] ?? '';
    $firmaConformidad = $_POST['firma_de_conformidad'] ?? '';

    // Manejar la carga del archivo si se proporciona uno
    $evidencia = $data['evidencia'] ?? '';
    if (isset($_FILES['evidencia']) && $_FILES['evidencia']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'path/to/uploads/';
        $uploadedFiles = [];
        foreach ($_FILES['evidencia']['name'] as $key => $name) {
            $uploadFile = $uploadDir . basename($name);
            if (move_uploaded_file($_FILES['evidencia']['tmp_name'][$key], $uploadFile)) {
                $uploadedFiles[] = basename($name);
            }
        }
        if ($uploadedFiles) {
            $evidencia = implode(',', $uploadedFiles);
        }
    }

    // Actualizar la base de datos con los nuevos datos
    try {
        $stmt = $pdo->prepare("
            UPDATE reinci
            SET
                tipo_inc = :tipoIncidencia,
                dep_rep = :depRep,
                descrip_inc = :descripInc,
                fecha_atencion = :fechaAtencion,
                firma_de_conformidad = :firmaConformidad,
                evidencia = :evidencia
            WHERE id = :id
        ");
        $stmt->execute([
            'tipoIncidencia' => $tipoIncidencia,
            'depRep' => $depRep,
            'descripInc' => $descripInc,
            'fechaAtencion' => $fechaAtencion,
            'firmaConformidad' => $firmaConformidad,
            'evidencia' => $evidencia,
            'id' => $id
        ]);
        // Redirigir después de la actualización
        echo "<script>
                alert('Datos actualizados correctamente.');
                window.location.href = document.referrer;
              </script>";
    } catch (PDOException $e) {
        echo "<script>
                alert('Error en la actualización: " . addslashes($e->getMessage()) . "');
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Respuesta</title>
    <style>
        .step { display: none; }
        .step.active { display: block; }
        #evidencePreview {
            display: flex;
            flex-wrap: wrap; /* Permite que los elementos se envuelvan en una nueva fila si es necesario */
            gap: 15px; /* Espacio entre los elementos */
        }
        .file-preview {
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .file-preview img {
            max-width: 150px;
            max-height: 150px;
        }
        .btn-secondary {
            margin-top: 10px; /* Espacio entre la imagen y el botón */
        }
    </style>
</head>
<body>
<div class="card mb-3 card-body col-md-8 mx-auto">
    <div class="z-1 col-md-8 mx-auto">
    <button type="button" id="backButton" class="btn btn-secondary" onclick="history.back()">
    <i class="bi bi-arrow-left"></i> Regresar
    </button>

    <!-- Botón para generar PDF -->
    <button type="button" id="generatePdfButton" class="btn btn-danger btn-sm" onclick="generatePDF()">
        <i class="fas fa-file-pdf"></i> 
    </button>

    <!-- Botón para generar CSV -->
    <button type="button" id="generateCsvButton" class="btn btn-info" onclick="generateCSV()">
        <i class="fas fa-file-csv"></i> 
    </button>
        <header>
            <h1 class="text-primary">F-GES-08 Reporte de incidencias informáticas</h1>
        </header>
        <?php if ($data): ?>
            <form id="multiStepForm" method="post" enctype="multipart/form-data">
                <!-- Paso 1 -->
                <div class="step active" id="step1">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($data['id']); ?>">
                    <div class="form-group">
                        <label for="noEmpleado">NoEmpleado</label>
                        <input type="text" id="noEmpleado" name="noEmpleado" class="form-control" value="<?php echo htmlspecialchars($data['noEmpleado']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nombreDepartamento">Nombre del Departamento</label>
                        <input type="text" id="nombreDepartamento" name="nombreDepartamento" class="form-control" value="<?php echo htmlspecialchars($data['nombreDepartamento']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nombreColaborador">Nombre de Colaborador</label>
                        <input type="text" id="nombreColaborador" name="nombreColaborador" class="form-control" value="<?php echo htmlspecialchars($data['nombreEmpleado']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="apellidoPaterno">Apellido Paterno</label>
                        <input type="text" id="apellidoPaterno" name="apellidoPaterno" class="form-control" value="<?php echo htmlspecialchars($data['apellidoPaterno']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="apellidoMaterno">Apellido Materno</label>
                        <input type="text" id="apellidoMaterno" name="apellidoMaterno" class="form-control" value="<?php echo htmlspecialchars($data['apellidoMaterno']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="correoElectronico">Correo Electrónico</label>
                        <input type="email" id="correoElectronico" name="correoElectronico" class="form-control" value="<?php echo htmlspecialchars($data['emailEmpleado']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="numeroTelefono">Número de Teléfono</label>
                        <input type="text" id="numeroTelefono" name="numeroTelefono" class="form-control" value="<?php echo htmlspecialchars($data['telefono']); ?>" readonly>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="nextStep(1)">Siguiente</button>
                </div>
                <!-- Paso 2 -->
                <div class="step" id="step2">
                    <div class="form-group">
                        <label for="folio">Folio</label>
                        <input type="text" id="folio" name="folio" class="form-control" value="<?php echo htmlspecialchars($data['folio']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="fechaReporte">Fecha de Reporte</label>
                        <input type="text" id="fechaReporte" name="fechaReporte" class="form-control" value="<?php echo htmlspecialchars($data['fecha_reporte']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tipo_inc">¿Qué tipo de incidencia reporta?</label>
                        <select id="tipo_inc" name="tipo_inc" class="form-select">
                            <option value="Hardware" <?php echo ($data['tipo_inc'] === 'Hardware') ? 'selected' : ''; ?>>Hardware (pantalla, impresora, disco duro ...)</option>
                            <option value="Internet" <?php echo ($data['tipo_inc'] === 'Internet') ? 'selected' : ''; ?>>Internet</option>
                            <option value="Software" <?php echo ($data['tipo_inc'] === 'Software') ? 'selected' : ''; ?>>Software (antivirus, office, correo electrónico ...)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dep_rep">Departamento Reportado</label>
                        <input type="text" id="dep_rep" name="dep_rep" class="form-control" value="<?php echo htmlspecialchars($data['dep_rep']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="descrip_inc">Descripción de la Incidencia</label>
                        <textarea id="descrip_inc" name="descrip_inc" class="form-control"><?php echo htmlspecialchars($data['descrip_inc']); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="evidencia">Evidencia</label>
                        <div id="evidencePreview">
                            <?php foreach ($evidenciaArray as $file): ?>
                                <div class="file-preview">
                                    <a href="Views/Resources/php/uploads/<?php echo htmlspecialchars($file); ?>" target="_blank">
                                        <img src="Views/Resources/php/uploads/<?php echo htmlspecialchars($file); ?>" alt="<?php echo htmlspecialchars($file); ?>" class="img-thumbnail">
                                    </a>
                                    <p><?php echo htmlspecialchars($file); ?></p>
                                    <!-- Enlace para descargar el archivo -->
                                    <a href="Views/Resources/php/uploads/<?php echo htmlspecialchars($file); ?>" download="<?php echo htmlspecialchars($file); ?>" class="btn btn-secondary btn-sm">
                                        Descargar
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fecha_atencion">Fecha de Atención</label>
                        <input type="date" id="fecha_atencion" name="fecha_atencion" class="form-control" value="<?php echo htmlspecialchars($data['fecha_atencion']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="firma_de_conformidad">Firma de Conformidad</label>
                        <input type="text" id="firma_de_conformidad" name="firma_de_conformidad" class="form-control" value="<?php echo htmlspecialchars($data['firma_de_conformidad']); ?>">
                    </div>
                    <br>
                    <button type="button" class="btn btn-secondary" onclick="prevStep(2)">Anterior</button>
                    <button type="button" class="btn btn-primary" onclick="nextStep(2)">Siguiente</button>
                    <button type="submit" class="btn btn-success">
                    <i class="fas fa-sync-alt"></i> Actualizar
                    </button>
                </div>

            </form>
        <?php else: ?>
            <p>No se encontraron detalles para este ID.</p>
        <?php endif; ?>
    </div>
</div>
</div>

    <script>
        function showStep(step) {
            document.querySelectorAll('.step').forEach(function(el) {
                el.classList.remove('active');
            });
            document.getElementById('step' + step).classList.add('active');
        }

        function nextStep(currentStep) {
            showStep(currentStep + 1);
        }

        function prevStep(currentStep) {
            showStep(currentStep - 1);
        }

         // Función para generar PDF
         function generatePDF() {
    var formElement = document.getElementById("multiStepForm");
    if (!formElement) {
        console.error('Elemento con ID "multiStepForm" no encontrado.');
        return;
    }

    // Obtener el ID del formulario (debe ser enviado como un campo oculto)
    var id = formElement.querySelector('[name="id"]').value;

    if (!id) {
        alert('No se ha encontrado el ID.');
        return;
    }

    var formData = new FormData();
    formData.append('id', id);

    fetch('Views/Pages/Forms/sections/export_pdf2.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.blob())
    .then(blob => {
        var url = URL.createObjectURL(blob);
        window.open(url, '_blank');
        URL.revokeObjectURL(url);
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al generar el PDF.');
    });
}

function generateCSV() {
    var formElement = document.getElementById("multiStepForm");
    if (!formElement) {
        console.error('Elemento con ID "multiStepForm" no encontrado.');
        return;
    }
    var id = formElement.querySelector('[name="id"]').value;

    if (!id) {
        alert('No se ha encontrado el ID.');
        return;
    }

    var formData = new FormData();
    formData.append('id', id);

    fetch('Views/Pages/Forms/sections/export_csv2.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.blob())
    .then(blob => {
        var url = URL.createObjectURL(blob);
        window.open(url, '_blank');
        URL.revokeObjectURL(url);
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al generar el CSV.');
    });
}

    // Exponer las funciones al ámbito global
    window.generatePDF = generatePDF;
    window.generateCSV = generateCSV;
    </script>
</body>
</html>
