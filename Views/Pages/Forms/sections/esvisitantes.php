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
$caracteristicas = [];
if ($id > 0) {
    try {
        // Obtener los detalles del visitante
        $stmt = $pdo->prepare("
            SELECT 
                e.id, 
                e.fechaSolicitud, 
                e.nombreEmpresa, 
                e.nombreVisitante, 
                e.correo, 
                e.telefono, 
                e.folio, 
                e.prioridad, 
                e.entradaOsalida, 
                e.fechaDevolucion, 
                e.finesUtilizacion, 
                e.nombreResponsable, 
                e.firmaDeresponsable, 
                e.aceptacionResponsabilidad, 
                e.nombreAUTho, 
                e.correoAUTho, 
                e.firmaAUTho, 
                e.evidencia
            FROM 
                esvisitantes e
            WHERE 
                e.id = :id
        ");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Obtener las características del equipo asociadas
        $stmt = $pdo->prepare("
            SELECT id, tipoEquipo, marca, modelo, numeroSerie, perteneceHO
            FROM esvisitantescaracteristicas
            WHERE ESVisitantes_id = :id
        ");
        $stmt->execute(['id' => $id]);
        $caracteristicas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error en la consulta: " . $e->getMessage());
    }
}

// Procesar la actualización del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prioridad = $_POST['prioridad'] ?? '';
    $entradaOsalida = $_POST['entradaOsalida'] ?? '';
    $fechaDevolucion = $_POST['fechaDevolucion'] ?? '';
    $finesUtilizacion = $_POST['finesUtilizacion'] ?? '';
    $nombreResponsable = $_POST['nombreResponsable'] ?? '';
    $firmaDeresponsable = $_POST['firmaDeresponsable'] ?? '';
    $aceptacionResponsabilidad = $_POST['aceptacionResponsabilidad'] ?? '';
    $nombreAUTho = $_POST['nombreAUTho'] ?? '';
    $correoAUTho = $_POST['correoAUTho'] ?? '';
    $firmaAUTho = $_POST['firmaAUTho'] ?? '';

    // Actualizar los detalles del visitante
    try {
        $stmt = $pdo->prepare("
            UPDATE esvisitantes SET
                prioridad = :prioridad,
                entradaOsalida = :entradaOsalida,
                fechaDevolucion = :fechaDevolucion,
                finesUtilizacion = :finesUtilizacion,
                nombreResponsable = :nombreResponsable,
                firmaDeresponsable = :firmaDeresponsable,
                aceptacionResponsabilidad = :aceptacionResponsabilidad,
                nombreAUTho = :nombreAUTho,
                correoAUTho = :correoAUTho,
                firmaAUTho = :firmaAUTho
            WHERE id = :id
        ");
        $stmt->execute([
            'prioridad' => $prioridad,
            'entradaOsalida' => $entradaOsalida,
            'fechaDevolucion' => $fechaDevolucion,
            'finesUtilizacion' => $finesUtilizacion,
            'nombreResponsable' => $nombreResponsable,
            'firmaDeresponsable' => $firmaDeresponsable,
            'aceptacionResponsabilidad' => $aceptacionResponsabilidad,
            'nombreAUTho' => $nombreAUTho,
            'correoAUTho' => $correoAUTho,
            'firmaAUTho' => $firmaAUTho,
            'id' => $id
        ]);

        // Actualizar las características del equipo
        if (isset($_POST['caracteristicas']) && is_array($_POST['caracteristicas'])) {
            foreach ($_POST['caracteristicas'] as $caracteristica) {
                $caracteristicaId = $caracteristica['id'] ?? null;
                if ($caracteristicaId !== null) {
                    $tipoEquipo = $caracteristica['tipoEquipo'] ?? '';
                    $marca = $caracteristica['marca'] ?? '';
                    $modelo = $caracteristica['modelo'] ?? '';
                    $numeroSerie = $caracteristica['numeroSerie'] ?? '';
                    $perteneceHO = $caracteristica['perteneceHO'] ?? '';

                    $stmt = $pdo->prepare("
                        UPDATE esvisitantescaracteristicas SET
                            tipoEquipo = :tipoEquipo,
                            marca = :marca,
                            modelo = :modelo,
                            numeroSerie = :numeroSerie,
                            perteneceHO = :perteneceHO
                        WHERE ESVisitantes_id = :id AND id = :caracteristica_id
                    ");
                    $stmt->execute([
                        'tipoEquipo' => $tipoEquipo,
                        'marca' => $marca,
                        'modelo' => $modelo,
                        'numeroSerie' => $numeroSerie,
                        'perteneceHO' => $perteneceHO,
                        'id' => $id,
                        'caracteristica_id' => $caracteristicaId
                    ]);
                } else {
                    echo "ID de característica no proporcionado.";
                    exit;
                }
            }
            // Redirigir o mostrar un mensaje de éxito
            echo "<p>Datos actualizados correctamente.</p>";
        } else {
            // Manejo en caso de que 'caracteristicas' no esté presente o no sea un array
            echo "No se encontraron características para procesar.";
        }
    } catch (PDOException $e) {
        die("Error al actualizar: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario por Secciones</title>
    <style>
        .step {
            display: none;
        }
        .step.active {
            display: block;
        }
        .step-buttons {
            display: flex;
            justify-content: space-between;
        }
        .form-control:disabled {
            background-color: #e9ecef;
            cursor: not-allowed;
        }
        .file-preview img {
            max-width: 30%;
            height: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 0.5rem;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
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
            <h1 class="text-primary">F-GES-04 Entrada/salida de equipo de cómputo (colaboradores) REV. 01</h1>
        </header>
        <form id="multiStepForm" method="POST" action="">
        <input type="hidden" name="form-id" id="form-id" value="<?php echo htmlspecialchars($id); ?>">
            <!-- Sección 1: Información General -->
            <div id="section1" class="step active">
                <?php if ($data): ?>
                    <div class="form-group">
                        <label for="fechaSolicitud">Fecha de solicitud </label>
                        <input type="text" id="fechaSolicitud" name="fechaSolicitud" class="form-control" value="<?php echo htmlspecialchars($data['fechaSolicitud']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nombreEmpresa">Nombre de la empresa</label>
                        <input type="text" id="nombreEmpresa" name="nombreEmpresa" class="form-control" value="<?php echo htmlspecialchars($data['nombreEmpresa']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nombreVisitante">Nombre de visitante</label>
                        <input type="text" id="	nombreVisitante" name="nombre_colaborador" class="form-control" value="<?php echo htmlspecialchars($data['nombreVisitante']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo electrónico</label>
                        <input type="text" id="correo" name="correo" class="form-control" value="<?php echo htmlspecialchars($data['correo']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Número de teléfono</label>
                        <input type="text" id="telefono" name="telefono" class="form-control" value="<?php echo htmlspecialchars($data['telefono']); ?>" readonly>
                    </div>

                <?php else: ?>
                    <p>No se encontraron detalles para este ID.</p>
                <?php endif; ?>
            </div>

            <!-- Sección 2: Información Adicional -->
            <div id="section2" class="step">
                <h2>Información Adicional</h2>
                <div class="form-group">
                    <label for="folio">Folio</label>
                    <input type="text" id="folio" name="folio" class="form-control" value="<?php echo htmlspecialchars($data['folio']); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="prioridad">Propiedad del equipo</label>
                    <select id="prioridad" name="prioridad" class="form-control">
                        <option value="Harinera de Oriente" <?php echo $data['prioridad'] === 'Harinera de Oriente' ? 'selected' : ''; ?>>Harinera de Oriente</option>
                        <option value="Uso personal" <?php echo $data['prioridad'] === 'Uso personal' ? 'selected' : ''; ?>>Uso personal</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="entradaOsalida">Entrada o Salida</label>
                    <select id="entradaOsalida" name="entradaOsalida" class="form-control">
                        <option value="Entrada" <?php echo $data['entradaOsalida'] === 'Entrada' ? 'selected' : ''; ?>>Entrada</option>
                        <option value="Salida" <?php echo $data['entradaOsalida'] === 'Salida' ? 'selected' : ''; ?>>Salida</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fecha_devolucion">Fecha de Devolución</label>
                    <input type="date" id="fechaDevolucion" name="fecha_devolucion" class="form-control" value="<?php echo htmlspecialchars($data['fechaDevolucion']); ?>">
                </div>
                <div class="form-group">
                    <label for="finesUtilizacion">Motivo</label>
                    <textarea id="finesUtilizacion" name="finesUtilizacion" class="form-control"><?php echo htmlspecialchars($data['finesUtilizacion']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="evidencia">Evidencia</label>
                    <?php if (!empty($data['evidencia']) && is_array($data['evidencia'])): ?>
                        <div class="file-preview">
                            <p>Vista Previa:</p>
                            <?php foreach ($data['evidencia'] as $file): ?>
                                <div class="file-item">
                                    <a href="Views/Resources/php/uploads/<?php echo htmlspecialchars($file); ?>" download>Descargar Archivo</a>
                                    <img src="Views/Resources/php/uploads/<?php echo htmlspecialchars($file); ?>" alt="Vista Previa" style="max-width: 100px; max-height: 100px;">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p>No hay archivos disponibles.</p>
                    <?php endif; ?>
                </div>
                <!-- Tabla de Información Adicional -->
                <h3>Datos Adicionales</h3>
                <table class="table table-bordered overflow-hidden" id="tipoequi">
                    <thead>
                        <tr>
                            <th>Tipo de equipo</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Número de serie</th>
                            <th>¿Este equipo pertenece a HO?</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($caracteristicas as $row): ?>
                            <tr>
                                <td>
                                <select name="tipoEquipo[]" class="form-select form-select-sm">
                                    <option value="Laptop" <?php echo ($row['tipoEquipo'] == 'Laptop') ? 'selected' : ''; ?>>Laptop</option>
                                    <option value="PC de escritorio" <?php echo ($row['tipoEquipo'] == 'PC de escritorio') ? 'selected' : ''; ?>>PC de escritorio</option>
                                    <option value="Tableta" <?php echo ($row['tipoEquipo'] == 'Tableta') ? 'selected' : ''; ?>>Tableta</option>
                                    <option value="Monitor/Pantalla/Proyector" <?php echo ($row['tipoEquipo'] == 'Monitor/Pantalla/Proyector') ? 'selected' : ''; ?>>Monitor/Pantalla/Proyector</option>
                                    <option value="Equipos de impresión y multifuncionales" <?php echo ($row['tipoEquipo'] == 'Equipos de impresión y multifuncionales') ? 'selected' : ''; ?>>Equipos de impresión y multifuncionales</option>
                                    <option value="Hardware (teclado/mouse/videocámaras/adaptadores)" <?php echo ($row['tipoEquipo'] == 'Hardware (teclado/mouse/videocámaras/adaptadores)') ? 'selected' : ''; ?>>Hardware (teclado/mouse/videocámaras/adaptadores)</option>
                                    <option value="Otro" <?php echo ($row['tipoEquipo'] == 'Otro') ? 'selected' : ''; ?>>Otro</option>
                                </select>

                                </td>
                                <td><?php echo htmlspecialchars($row['marca']); ?></td>
                                <td><?php echo htmlspecialchars($row['modelo']); ?></td>
                                <td><?php echo htmlspecialchars($row['numeroSerie']); ?></td>
                                <td><?php echo htmlspecialchars($row['perteneceHO']); ?></td>

                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Eliminar</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button class="btn btn-falcon-default btn-sm me-1 mb-1" type="button" onclick="addRow()"> + Agregar Fila</button>
            </div>
            <div id="section3" class="step">
                <h2>Información Adicional</h2>
                <div class="form-group">
                    <label for="nombre_colaborador">Nombre de responsable</label>
                    <input type="text" id="nombre_colaborador" name="nombre_colaborador" class="form-control" value="<?php echo htmlspecialchars($data['nombreResponsable']); ?>">
                </div>
                <div class="form-group">
                    <label for="firma_responsable">Firma de responsable</label>
                    <input type="text" id="firma_responsable" name="firma_responsable" class="form-control" value="<?php echo htmlspecialchars($data['firmaDeresponsable']); ?>">
                </div>
                <div class="form-group">
                    <label for="aceptacion_responsabilidad">Aceptación de responsabilidad</label>
                    <input type="text" id="aceptacion_responsabilidad" name="aceptacion_responsabilidad" class="form-control" value="<?php echo htmlspecialchars($data['aceptacionResponsabilidad']); ?>">
                </div>
                <div class="form-group">
                    <label for="nombre_autorizador">Nombre de quien autoriza en HO</label>
                    <input type="text" id="nombre_autorizador" name="nombre_autorizador" class="form-control" value="<?php echo htmlspecialchars($data['nombreAUTho']); ?>">
                </div>
                <div class="form-group">
                    <label for="correo_autorizador">Correo electrónico de quien autoriza en HO</label>
                    <input type="text" id="correo_autorizador" name="correo_autorizador" class="form-control" value="<?php echo htmlspecialchars($data['correoAUTho']); ?>">
                </div>
                <div class="form-group">
                    <label for="firma_autorizador">Firma de quien autoriza en HO</label>
                    <input type="text" id="firma_autorizador" name="firma_autorizador" class="form-control" value="<?php echo htmlspecialchars($data['firmaAUTho']); ?>">
                </div>
                
            </div>
<br>

            <div class="step-buttons">
                <button type="button" id="prevBtn" class="btn btn-primary" onclick="changeStep(-1)">Anterior</button>
                <button type="button" id="nextBtn" class="btn btn-primary" onclick="changeStep(1)">Siguiente</button>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-sync-alt"></i> Actualizar
                </button>
            </div>
        </form>
    </div>
</div>

    <script>
        let currentStep = 0;
        const steps = document.querySelectorAll('.step');

        function showStep(stepIndex) {
            steps.forEach((step, index) => {
                step.classList.toggle('active', index === stepIndex);
            });
            document.getElementById('prevBtn').style.display = stepIndex === 0 ? 'none' : 'inline-block';
            document.getElementById('nextBtn').style.display = stepIndex === steps.length - 1 ? 'none' : 'inline-block';
        }

        function changeStep(stepChange) {
            const newStep = currentStep + stepChange;
            if (newStep >= 0 && newStep < steps.length) {
                currentStep = newStep;
                showStep(currentStep);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            showStep(currentStep);
        });

        function addRow() {
            const table = document.getElementById('tipoequi').getElementsByTagName('tbody')[0];
            const rowCount = table.rows.length;
            const newRow = table.insertRow();
            newRow.innerHTML = `
                <td>
                    <select name="caracteristicas[${rowCount}][tipo_equipo]" class="form-select form-select-sm">
                        <option value="Laptop">Laptop</option>
                        <option value="PC de escritorio">PC de escritorio</option>
                        <option value="Tableta">Tableta</option>
                        <option value="Monitor/Pantalla/Proyector">Monitor/Pantalla/Proyector</option>
                        <option value="Equipos de impresión y multifuncionales">Equipos de impresión y multifuncionales</option>
                        <option value="Hardware (teclado/mouse/videocámaras/adaptadores)">Hardware (teclado/mouse/videocámaras/adaptadores)</option>
                        <option value="Otro">Otro</option>
                    </select>
                </td>
                <td><input type="text" name="caracteristicas[${rowCount}][marca]" class="form-control"></td>
                <td><input type="text" name="caracteristicas[${rowCount}][modelo]" class="form-control"></td>
                <td><input type="text" name="caracteristicas[${rowCount}][numero_serie]" class="form-control"></td>
                <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Eliminar</button></td>
            `;
        }

        function removeRow(button) {
            const row = button.closest('tr');
            row.remove();
        }

         // Función para generar PDF
    function generatePDF() {
        var idElement = document.getElementById("form-id");
        if (!idElement) {
            console.error('Elemento con ID "form-id" no encontrado.');
            return;
        }
        var id = idElement.value;

        if (!id) {
            alert('No se ha encontrado el ID.');
            return;
        }

        var formData = new FormData();
        formData.append('id', id);

        fetch('Views/Pages/Forms/sections/export_pdf1.php', {
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

    // Función para generar CSV
    function generateCSV() {
        var idElement = document.getElementById("form-id");
        if (!idElement) {
            console.error('Elemento con ID "form-id" no encontrado.');
            return;
        }
        var id = idElement.value;

        if (!id) {
            alert('No se ha encontrado el ID.');
            return;
        }

        var formData = new FormData();
        formData.append('id', id);

        fetch('Views/Pages/Forms/sections/export_csv1.php', {
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

    // Inicializar la visualización del primer paso
    showStep(currentStep);

    // Exponer las funciones al ámbito global
    window.generatePDF = generatePDF;
    window.generateCSV = generateCSV;
    window.nextPrev = nextPrev;
    </script>
</body>
</html>

