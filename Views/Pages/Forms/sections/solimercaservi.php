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
        // Obtener datos generales del formulario
        $noEmpleado = $_POST['noEmpleado'];
        $idDepartamento = $_POST['idDepartamento'];
        $nombreEmpleado = $_POST['nombreEmpleado'];
        $apellidoPaterno = $_POST['apellidoPaterno'];
        $apellidoMaterno = $_POST['apellidoMaterno'];
        $emailEmpleado = $_POST['emailEmpleado'];
        $telefono = $_POST['telefono'];
        $folio = $_POST['folio'];
        $Prioridad = $_POST['Prioridad'];
        $gestiona = $_POST['gestiona'];
        $fecha_pedido = $_POST['fecha_pedido'];
        $fecha_entrega = $_POST['fecha_entrega'];
        $fines_utilizacion = $_POST['fines_utilizacion'];
        $nombre_solicitud = $_POST['nombre_solicitud'];
        $firma_solicitud = $_POST['firma_solicitud'];
        $nombre_jefe = $_POST['nombre_jefe'];
        $correo_jefe = $_POST['correo_jefe'];
        $firma_jefe_recibe = $_POST['firma_jefe_recibe'];
        $nombre_recibe = $_POST['nombre_recibe'];
        $firma_recibe = $_POST['firma_recibe'];

        // Actualizar datos generales
        $updateStmt = $pdo->prepare("
            UPDATE solimercaservi
            SET noEmpleado = :noEmpleado, idDepartamento = :idDepartamento, nombreEmpleado = :nombreEmpleado,
                apellidoPaterno = :apellidoPaterno, apellidoMaterno = :apellidoMaterno, emailEmpleado = :emailEmpleado,
                telefono = :telefono, folio = :folio, Prioridad = :Prioridad, gestiona = :gestiona,
                fecha_pedido = :fecha_pedido, fecha_entrega = :fecha_entrega, fines_utilizacion = :fines_utilizacion,
                nombre_solicitud = :nombre_solicitud, firma_solicitud = :firma_solicitud, nombre_jefe = :nombre_jefe,
                correo_jefe = :correo_jefe, firma_jefe_recibe = :firma_jefe_recibe, nombre_recibe = :nombre_recibe,
                firma_recibe = :firma_recibe
            WHERE id = :id
        ");
        $updateStmt->execute([
            'id' => $id,
            'noEmpleado' => $noEmpleado,
            'idDepartamento' => $idDepartamento,
            'nombreEmpleado' => $nombreEmpleado,
            'apellidoPaterno' => $apellidoPaterno,
            'apellidoMaterno' => $apellidoMaterno,
            'emailEmpleado' => $emailEmpleado,
            'telefono' => $telefono,
            'folio' => $folio,
            'Prioridad' => $Prioridad,
            'gestiona' => $gestiona,
            'fecha_pedido' => $fecha_pedido,
            'fecha_entrega' => $fecha_entrega,
            'fines_utilizacion' => $fines_utilizacion,
            'nombre_solicitud' => $nombre_solicitud,
            'firma_solicitud' => $firma_solicitud,
            'nombre_jefe' => $nombre_jefe,
            'correo_jefe' => $correo_jefe,
            'firma_jefe_recibe' => $firma_jefe_recibe,
            'nombre_recibe' => $nombre_recibe,
            'firma_recibe' => $firma_recibe
        ]);

        // Borrar detalles anteriores de la tabla de mercancías y servicios
        $deleteDetailsQuery = "DELETE FROM mercancias_servicios WHERE soliMercaServi_id = :id";
        $stmt = $pdo->prepare($deleteDetailsQuery);
        $stmt->execute([':id' => $id]);

        // Insertar nuevos detalles de mercancía y servicios
        $partida = $_POST['partida'];
        $cantidad = $_POST['cantidad'];
        $unidad = $_POST['unidad'];
        $descripcion = $_POST['descripcion'];

        $insertDetailsQuery = "INSERT INTO mercancias_servicios (soliMercaServi_id, partida, cantidad, unidad, descripcion) VALUES (:soliMercaServi_id, :partida, :cantidad, :unidad, :descripcion)";
        $stmt = $pdo->prepare($insertDetailsQuery);

        foreach ($partida as $index => $value) {
            $stmt->execute([
                ':soliMercaServi_id' => $id,
                ':partida' => $partida[$index],
                ':cantidad' => $cantidad[$index],
                ':unidad' => $unidad[$index],
                ':descripcion' => $descripcion[$index]
            ]);
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
            SELECT s.id, s.noEmpleado, s.idDepartamento, s.nombreEmpleado, s.apellidoPaterno, s.apellidoMaterno, s.emailEmpleado, s.telefono,
                   s.folio, s.Prioridad, s.gestiona, s.fecha_pedido, s.fecha_entrega, s.fines_utilizacion, s.nombre_solicitud, s.firma_solicitud,
                   s.nombre_jefe, s.correo_jefe, s.nombre_recibe, s.firma_recibe, s.firma_jefe_recibe,
                   sm.partida, sm.cantidad, sm.unidad, sm.descripcion
            FROM solimercaservi s
            LEFT JOIN mercancias_servicios sm ON s.id = sm.soliMercaServi_id
            WHERE s.id = :id
        ");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error en la consulta: " . $e->getMessage());
    }
} else {
    $data = [];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Respuesta</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .step {
            display: none;
        }
        .step.active {
            display: block;
        }
        .dropdown-menu-custom {
            right: 0;
            left: auto;
            margin-left: 0;
            margin-right: 0;
            top: 100%;
        }
        .dropdown-toggle::after {
            display: none; /* Elimina el triángulo que indica el menú desplegable */
        }
    </style>
</head>
<body>
<div class="card mb-3 card-body col-md-8 mx-auto">
    <div class="z-1 col-md-8 mx-auto">
    <!-- Botón para actualizar -->

    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="tablevacanteLaboral">Tabla</a></li>
        <li class="breadcrumb-item active" aria-current="page">Página Actual</li>
    </ol>
    </nav>
    <!-- Botón para generar PDF -->
    <div class="d-flex justify-content-end ">
    <button type="button" id="generatePdfButton" class="btn btn-danger btn-sm" onclick="generatePDF()">
            <i class="fas fa-file-pdf"></i> Generar pdf
        </button>
    </div>
    
        <header>
            <h1 class="text-primary">Detalles de Respuestas solicitud de mercancia</h1>
        </header>
        
    </div>
    <div class="card-body col-md-8 mx-auto">
        <?php if ($data): ?>
            <form id="form-steps" method="post">
                <input type="hidden" name="form-id" id="form-id" value="<?php echo htmlspecialchars($id); ?>">

                <div class="step active">
                    <?php 
                    $generalFields = ['noEmpleado', 'idDepartamento', 'nombreEmpleado', 'apellidoPaterno', 'apellidoMaterno', 'emailEmpleado', 'telefono'];
                    foreach ($generalFields as $key): ?>
                        <div class="form-group">
                            <label for="<?php echo htmlspecialchars($key); ?>">
                                <?php echo htmlspecialchars(ucfirst(str_replace('_', ' ', $key)) ?? ''); ?>
                            </label>
                            <input type="text" 
                                id="<?php echo htmlspecialchars($key); ?>" 
                                name="<?php echo htmlspecialchars($key); ?>"
                                class="form-control form-control-sm"
                                value="<?php echo htmlspecialchars($data[0][$key] ?? ''); ?>"
                                readonly>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="step">
                    <?php 
                    $detailsFields = [
                        'folio' => ['readonly' => true],
                        'Prioridad' => [
                            'readonly' => false, 
                            'options' => ['Programado', 'Urgente']
                        ],
                        'gestiona' => [
                            'readonly' => false, 
                            'options' => ['Compras (Departamento de compras)', 'Directa (Departamento que hace la solicitud)']
                        ],
                        'fecha_pedido' => ['readonly' => true],
                        'fecha_entrega' => ['readonly' => false, 'type' => 'date'],
                        'fines_utilizacion' => ['readonly' => false]
                    ];

                    foreach ($detailsFields as $key => $attributes): ?>
                        <div class="form-group">
                            <label for="<?php echo htmlspecialchars($key); ?>">
                                <?php echo htmlspecialchars(ucfirst(str_replace('_', ' ', $key)) ?? ''); ?>
                            </label>
                            <?php if (isset($attributes['options'])): ?>
                                <select id="<?php echo htmlspecialchars($key); ?>" 
                                        name="<?php echo htmlspecialchars($key); ?>"
                                        class="form-control form-control-sm"
                                        <?php echo isset($attributes['readonly']) && $attributes['readonly'] ? 'disabled' : ''; ?>>
                                    <?php foreach ($attributes['options'] as $option): ?>
                                        <option value="<?php echo htmlspecialchars($option); ?>" 
                                                <?php echo htmlspecialchars($data[0][$key] ?? '') === htmlspecialchars($option) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($option); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            <?php elseif (isset($attributes['type']) && $attributes['type'] === 'date'): ?>
                                <input type="date" 
                                    id="<?php echo htmlspecialchars($key); ?>" 
                                    name="<?php echo htmlspecialchars($key); ?>"
                                    class="form-control form-control-sm"
                                    value="<?php echo htmlspecialchars($data[0][$key] ?? ''); ?>"
                                    <?php echo isset($attributes['readonly']) && $attributes['readonly'] ? 'readonly' : ''; ?>>
                            <?php else: ?>
                                <input type="text" 
                                    id="<?php echo htmlspecialchars($key); ?>" 
                                    name="<?php echo htmlspecialchars($key); ?>"
                                    class="form-control form-control-sm"
                                    value="<?php echo htmlspecialchars($data[0][$key] ?? ''); ?>"
                                    <?php echo isset($attributes['readonly']) && $attributes['readonly'] ? 'readonly' : ''; ?>>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>

                    <h3>Detalles de Mercancía</h3>
                    <table class="table table-bordered overflow-hidden" id="mercancia-table">
                    <colgroup>
                        <col />
                        <col />
                        <col />
                        <col />
                    </colgroup>
                    <thead>
                        <tr>
                            <th scope="col">Partida</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Unidad</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php foreach ($data as $row): ?>
            <tr>
                <td><input type="text" name="partida[]" class="form-control partida-input" value="<?php echo htmlspecialchars($row['partida'] ?? ''); ?>"></td>
                <td><input type="number" name="cantidad[]" class="form-control cantidad-input" value="<?php echo htmlspecialchars($row['cantidad'] ?? ''); ?>"></td>
                <td>
                    <select name="unidad[]" class="form-select form-select-sm">
                        <!-- Definir opciones para "unidad" -->
                        <option value="pza" <?php echo ($row['unidad'] == 'pza') ? 'selected' : ''; ?>>pza</option>
                        <option value="mt" <?php echo ($row['unidad'] == 'mt') ? 'selected' : ''; ?>>mt</option>
                        <option value="lt" <?php echo ($row['unidad'] == 'lt') ? 'selected' : ''; ?>>lt</option>
                        <option value="kg" <?php echo ($row['unidad'] == 'kg') ? 'selected' : ''; ?>>kg</option>
                        <option value="servicio" <?php echo ($row['unidad'] == 'servicio') ? 'selected' : ''; ?>>servicio</option>
                        <!-- Añadir más opciones según sea necesario -->
                    </select>
                </td>
                <td><input type="text" name="descripcion[]" class="form-control descripcion-input" value="<?php echo htmlspecialchars($row['descripcion'] ?? ''); ?>"></td>
                <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Eliminar</button></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<button class="btn btn-falcon-default btn-sm me-1 mb-1" type="button" onclick="addRow()"> + Agregar Fila</button>
                </div>

                <div class="step">
                    <?php 
                    $approvalFields = ['nombre_solicitud', 'firma_solicitud', 'nombre_jefe', 'correo_jefe', 'firma_jefe_recibe', 'nombre_recibe', 'firma_recibe'];
                    foreach ($approvalFields as $key): ?>
                        <div class="form-group">
                            <label for="<?php echo htmlspecialchars($key); ?>">
                                <?php echo htmlspecialchars(ucfirst(str_replace('_', ' ', $key)) ?? ''); ?>
                            </label>
                            <input type="text" 
                                   id="<?php echo htmlspecialchars($key); ?>" 
                                   name="<?php echo htmlspecialchars($key); ?>"
                                   class="form-control form-control-sm"
                                   value="<?php echo htmlspecialchars($data[0][$key] ?? ''); ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
                <br>
                <div class="form-group">
                    <button type="button" id="prevBtn" class="btn btn-primary" onclick="nextPrev(-1)">Anterior</button>
                    <button type="button" id="nextBtn" class="btn btn-primary" onclick="nextPrev(1)">Siguiente</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-sync-alt"></i> Actualizar
                    </button>
                </div>
                <br>
            </form>
        <?php else: ?>
            <p>No se encontraron datos para este ID.</p>
        <?php endif; ?>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var currentStep = 0;

    // Función para mostrar el paso actual
    function showStep(stepIndex) {
        var steps = document.getElementsByClassName("step");
        for (var i = 0; i < steps.length; i++) {
            steps[i].classList.remove("active");
        }
        steps[stepIndex].classList.add("active");

        document.getElementById("prevBtn").style.display = stepIndex === 0 ? "none" : "inline";
        document.getElementById("nextBtn").style.display = stepIndex === steps.length - 1 ? "none" : "inline";
    }

    // Función para manejar la navegación entre pasos
    function nextPrev(direction) {
        var steps = document.getElementsByClassName("step");
        if (currentStep + direction >= 0 && currentStep + direction < steps.length) {
            steps[currentStep].classList.remove("active");
            currentStep += direction;
            showStep(currentStep);
        }
    }

    // Agregar fila a la tabla
    window.addRow = function() {
        var table = document.getElementById('mercancia-table').getElementsByTagName('tbody')[0];
        var newRow = table.insertRow();
        newRow.innerHTML = `
            <td><input type="text" class="form-control partida-input" name="partida[]"></td>
            <td><input type="number" class="form-control cantidad-input" name="cantidad[]"></td>
            <td><select class="form-select form-select-sm" name="unidad[]">
                            <option value="pza">pza.</option>
                            <option value="mt">mt.</option>
                            <option value="lt">lt.</option>
                            <option value="kg">kg.</option>
                            <option value="servicio">servicio</option>
                       </select></td>
            <td><input type="text" class="form-control descripcion-input" name="descripcion[]"></td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Eliminar</button></td>
        `;
    }

    // Eliminar fila de la tabla
    window.removeRow = function(button) {
        var row = button.closest('tr');
        row.parentNode.removeChild(row);
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

        fetch('Views/Pages/Forms/sections/export_pdf.php', {
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

        fetch('Views/Pages/Forms/sections/export_csv.php', {
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
});



</script>
</body>
</html>

