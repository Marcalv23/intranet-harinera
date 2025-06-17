<?php
// Habilitar la visualización de errores para la depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir archivo de conexión
require_once 'Models/Connection.php';

// Obtener la instancia de PDO
$pdo = Connection::connectionBD();

// Obtener el ID de la consulta
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $id > 0) {
    try {
        // Obtener datos actuales del registro
        $stmt = $pdo->prepare("
            SELECT * FROM escolaboradores
            WHERE id = :id
        ");
        $stmt->execute(['id' => $id]);
        $currentData = $stmt->fetch(PDO::FETCH_ASSOC);

        // Datos nuevos del formulario, excluyendo campos no modificables
        $data = [
            'nombreEmpleado' => $_POST['nombreEmpleado'] ?? $currentData['nombreEmpleado'],
            'apellidoPaterno' => $_POST['apellidoPaterno'] ?? $currentData['apellidoPaterno'],
            'apellidoMaterno' => $_POST['apellidoMaterno'] ?? $currentData['apellidoMaterno'],
            'emailEmpleado' => $_POST['emailEmpleado'] ?? $currentData['emailEmpleado'],
            'telefono' => $_POST['telefono'] ?? $currentData['telefono'],
            'propietario_equipo' => $_POST['propietario_equipo'] ?? '',
            'entrada_salida' => $_POST['entrada_salida'] ?? '',
            'fecha_devolucion' => $_POST['fecha_devolucion'] ?? '',
            'motivo' => $_POST['motivo'] ?? '',
            'evidencia' => $_POST['evidencia'] ?? '',
            'nombre_colaborador' => $_POST['nombre_colaborador'] ?? '',
            'firma_responsable' => $_POST['firma_responsable'] ?? '',
            'aceptacion_responsabilidad' => $_POST['aceptacion_responsabilidad'] ?? '',
            'nombre_autorizador' => $_POST['nombre_autorizador'] ?? '',
            'correo_autorizador' => $_POST['correo_autorizador'] ?? '',
            'firma_autorizador' => $_POST['firma_autorizador'] ?? ''
        ];

        // Comparar y actualizar solo los campos que han cambiado
        $updateFields = [];
        $params = [];
        foreach ($data as $key => $value) {
            if ($currentData[$key] != $value && !in_array($key, ['noEmpleado', 'nombreDepartamento', 'folio', 'fecha_solicitud'])) {
                $updateFields[] = "$key = :$key";
                $params[$key] = $value;
            }
        }

        if (!empty($updateFields)) {
            $params['id'] = $id;
            $updateSQL = "
                UPDATE escolaboradores
                SET " . implode(', ', $updateFields) . "
                WHERE id = :id
            ";
            $updateStmt = $pdo->prepare($updateSQL);
            $updateStmt->execute($params);
        }

        // Borrar detalles anteriores de la tabla de características solo si se deben actualizar
        if (isset($_POST['caracteristicas']) && is_array($_POST['caracteristicas'])) {
            $deleteDetailsQuery = "DELETE FROM caracteristicasescolaboradores WHERE ESColaboradores_id = :id";
            $stmt = $pdo->prepare($deleteDetailsQuery);
            $stmt->execute(['id' => $id]);

            // Insertar nuevos detalles de características
            $insertDetailsQuery = "INSERT INTO caracteristicasescolaboradores (ESColaboradores_id, tipo_equipo, marca, modelo, numero_serie)
                                   VALUES (:id, :tipo_equipo, :marca, :modelo, :numero_serie)
                                   ON DUPLICATE KEY UPDATE
                                       tipo_equipo = VALUES(tipo_equipo),
                                       marca = VALUES(marca),
                                       modelo = VALUES(modelo),
                                       numero_serie = VALUES(numero_serie)";
            $stmt = $pdo->prepare($insertDetailsQuery);

            foreach ($_POST['caracteristicas'] as $caracteristica) {
                $stmt->execute([
                    'id' => $id,
                    'tipo_equipo' => $caracteristica['tipo_equipo'] ?? '',
                    'marca' => $caracteristica['marca'] ?? '',
                    'modelo' => $caracteristica['modelo'] ?? '',
                    'numero_serie' => $caracteristica['numero_serie'] ?? ''
                ]);
            }
        }

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

if ($id > 0) {
    // Consultar datos basados en el ID
    try {
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

         // Convertir la cadena de archivos en un array
         $data['evidencia'] = !empty($data['evidencia']) ? explode(',', $data['evidencia']) : [];

        // Obtener las características del equipo asociadas
        $stmt = $pdo->prepare("
            SELECT tipo_equipo, marca, modelo, numero_serie
            FROM caracteristicasescolaboradores
            WHERE ESColaboradores_id = :id
        ");
        $stmt->execute(['id' => $id]);
        $caracteristicas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error en la consulta: " . $e->getMessage());
    }
} else {
    $data = [];
    $caracteristicas = [];
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
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="tablevacanteLaboral">Tabla</a></li>
        <li class="breadcrumb-item active" aria-current="page">Página Actual</li>
    </ol>
    </nav>
    <div class="dropdown" align="right">
            <button class="btn-sm dropdown-toggle btn dropdown-toggle mb-2 btn-info" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i> <!-- Icono de tres puntos -->
            </button>
            <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="dropdownMenuButton">
                <li>
                    <a class="dropdown-item" href="#" onclick="generatePDF()">
                        <i class="fas fa-file-pdf"></i> Generar PDF
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#" onclick="generateCSV()">
                        <i class="fas fa-file-csv"></i> Generar CSV
                    </a>
                </li>
            </ul>
    </div>
        <header>
            <h1 class="text-primary">F-GES-04 Entrada/salida de equipo de cómputo (colaboradores) REV. 01</h1>
        </header>
        <form id="multiStepForm" method="POST" action="">
        <input type="hidden" name="form-id" id="form-id" value="<?php echo htmlspecialchars($id); ?>">
            <!-- Sección 1: Información General -->
            <div id="section1" class="step active">
                <?php if ($data): ?>
                    <div class="form-group">
                        <label for="no_colaborador">N de Colaborador</label>
                        <input type="text" id="no_colaborador" name="no_colaborador" class="form-control" value="<?php echo htmlspecialchars($data['noEmpleado']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="departamento">Departamento</label>
                        <input type="text" id="departamento" name="departamento" class="form-control" value="<?php echo htmlspecialchars($data['nombreDepartamento']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nombre_colaborador">Nombre de Colaborador</label>
                        <input type="text" id="nombre_colaborador" name="nombre_colaborador" class="form-control" value="<?php echo htmlspecialchars($data['nombreEmpleado']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="apellido_paterno">Apellido Paterno</label>
                        <input type="text" id="apellido_paterno" name="apellido_paterno" class="form-control" value="<?php echo htmlspecialchars($data['apellidoPaterno']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="apellido_materno">Apellido Materno</label>
                        <input type="text" id="apellido_materno" name="apellido_materno" class="form-control" value="<?php echo htmlspecialchars($data['apellidoMaterno']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="correo_electronico">Correo Electrónico</label>
                        <input type="email" id="correo_electronico" name="correo_electronico" class="form-control" value="<?php echo htmlspecialchars($data['emailEmpleado']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="numero_telefono">Número de Teléfono</label>
                        <input type="text" id="numero_telefono" name="numero_telefono" class="form-control" value="<?php echo htmlspecialchars($data['telefono']); ?>" readonly>
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
                    <label for="fecha_solicitud">Fecha de Solicitud</label>
                    <input type="text" id="fecha_solicitud" name="fecha_solicitud" class="form-control" value="<?php echo htmlspecialchars($data['fecha_solicitud']); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="propietario_equipo">Propietario del Equipo</label>
                    <select id="propietario_equipo" name="propietario_equipo" class="form-control">
                        <option value="Harinera de Oriente" <?php echo $data['propietario_equipo'] === 'Harinera de Oriente' ? 'selected' : ''; ?>>Harinera de Oriente</option>
                        <option value="Uso personal" <?php echo $data['propietario_equipo'] === 'Uso personal' ? 'selected' : ''; ?>>Uso personal</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="entrada_salida">Entrada o Salida</label>
                    <select id="entrada_salida" name="entrada_salida" class="form-control">
                        <option value="Entrada" <?php echo $data['entrada_salida'] === 'Entrada' ? 'selected' : ''; ?>>Entrada</option>
                        <option value="Salida" <?php echo $data['entrada_salida'] === 'Salida' ? 'selected' : ''; ?>>Salida</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fecha_devolucion">Fecha de Devolución</label>
                    <input type="date" id="fecha_devolucion" name="fecha_devolucion" class="form-control" value="<?php echo htmlspecialchars($data['fecha_devolucion']); ?>">
                </div>
                <div class="form-group">
                    <label for="motivo">Motivo</label>
                    <textarea id="motivo" name="motivo" class="form-control"><?php echo htmlspecialchars($data['motivo']); ?></textarea>
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
                            <th>Tipo</th>
                            <th>Cantidad</th>
                            <th>Unidad</th>
                            <th>Descripción</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($caracteristicas as $row): ?>
                            <tr>
                                <td>
                                <select name="tipo_equipo[]" class="form-select form-select-sm">
                                    <option value="Laptop" <?php echo ($row['tipo_equipo'] == 'Laptop') ? 'selected' : ''; ?>>Laptop</option>
                                    <option value="PC de escritorio" <?php echo ($row['tipo_equipo'] == 'PC de escritorio') ? 'selected' : ''; ?>>PC de escritorio</option>
                                    <option value="Tableta" <?php echo ($row['tipo_equipo'] == 'Tableta') ? 'selected' : ''; ?>>Tableta</option>
                                    <option value="Monitor/Pantalla/Proyector" <?php echo ($row['tipo_equipo'] == 'Monitor/Pantalla/Proyector') ? 'selected' : ''; ?>>Monitor/Pantalla/Proyector</option>
                                    <option value="Equipos de impresión y multifuncionales" <?php echo ($row['tipo_equipo'] == 'Equipos de impresión y multifuncionales') ? 'selected' : ''; ?>>Equipos de impresión y multifuncionales</option>
                                    <option value="Hardware (teclado/mouse/videocámaras/adaptadores)" <?php echo ($row['tipo_equipo'] == 'Hardware (teclado/mouse/videocámaras/adaptadores)') ? 'selected' : ''; ?>>Hardware (teclado/mouse/videocámaras/adaptadores)</option>
                                    <option value="Otro" <?php echo ($row['tipo_equipo'] == 'Otro') ? 'selected' : ''; ?>>Otro</option>
                                </select>

                                </td>
                                <td><?php echo htmlspecialchars($row['marca']); ?></td>
                                <td><?php echo htmlspecialchars($row['modelo']); ?></td>
                                <td><?php echo htmlspecialchars($row['numero_serie']); ?></td>
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
                    <label for="nombre_colaborador">Nombre del Colaborador</label>
                    <input type="text" id="nombre_colaborador" name="nombre_colaborador" class="form-control" value="<?php echo htmlspecialchars($data['nombre_colaborador']); ?>">
                </div>
                <div class="form-group">
                    <label for="firma_responsable">Firma de responsable</label>
                    <input type="text" id="firma_responsable" name="firma_responsable" class="form-control" value="<?php echo htmlspecialchars($data['firma_responsable']); ?>">
                </div>
                <div class="form-group">
                    <label for="aceptacion_responsabilidad">Aceptación de responsabilidad</label>
                    <input type="text" id="aceptacion_responsabilidad" name="aceptacion_responsabilidad" class="form-control" value="<?php echo htmlspecialchars($data['aceptacion_responsabilidad']); ?>">
                </div>
                <div class="form-group">
                    <label for="nombre_autorizador">Nombre de quien autoriza</label>
                    <input type="text" id="nombre_autorizador" name="nombre_autorizador" class="form-control" value="<?php echo htmlspecialchars($data['nombre_autorizador']); ?>">
                </div>
                <div class="form-group">
                    <label for="correo_autorizador">Correo electrónico de quien autoriza</label>
                    <input type="text" id="correo_autorizador" name="correo_autorizador" class="form-control" value="<?php echo htmlspecialchars($data['correo_autorizador']); ?>">
                </div>
                <div class="form-group">
                    <label for="firma_autorizador">Firma de quien autoriza</label>
                    <input type="text" id="firma_autorizador" name="firma_autorizador" class="form-control" value="<?php echo htmlspecialchars($data['firma_autorizador']); ?>">
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
    </script>
</body>
</html>

