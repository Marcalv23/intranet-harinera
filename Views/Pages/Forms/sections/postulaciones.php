<?php
// Habilitar la visualización de errores para la depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'Models/Connection.php'; // Ajusta la ruta según tu estructura de carpetas

// Obtener la instancia de PDO
$pdo = Connection::connectionBD();

// Obtener el ID de la consulta
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Consulta para obtener detalles basados en el ID
    try {
        $stmt = $pdo->prepare("SELECT * FROM postulaciones WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <style>
        .step {
            display: none;
        }

        .step.active {
            display: block;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .button-container {
            margin-top: 20px;
        }

        .button-container button {
            padding: 10px 15px;
            font-size: 16px;
        }
    </style>
</head>
<body>
<div class="card mb-3 card-body col-md-8 mx-auto">
    <div class="z-1 col-md-8 mx-auto">
        <button type="button" id="backButton" class="btn btn-secondary" onclick="history.back()">
            <i class="bi bi-arrow-left"></i> Regresar
        </button>
        <h1>Detalles de Respuesta</h1>
        <form action="update_postulacion.php" method="POST">
            <?php if ($data): ?>
                <div id="step-1" class="step active">
                    <h3>Paso 1: Puesto y Evidencia</h3>
                    <div class="form-group">
                        <label for="puesto">Puesto al que postula</label>
                        <input type="text" id="puesto" name="puesto" value="<?php echo htmlspecialchars($data['puesto'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="evidencia">Archivo Evidencia</label>
                        <input type="text" id="evidencia" name="evidencia" value="<?php echo htmlspecialchars($data['evidencia'] ?? ''); ?>">
                    </div>
                    <div class="button-container">
                        <button type="button" id="nextStep">Siguiente</button>
                    </div>
                </div>

                <div id="step-2" class="step">
                    <h3>Paso 2: Información Personal</h3>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($data['nombre'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($data['apellido'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="edad">Edad</label>
                        <input type="number" id="edad" name="edad" value="<?php echo htmlspecialchars($data['edad'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="sexo">Sexo</label>
                        <select id="sexo" name="sexo">
                            <option value="M" <?php echo $data['sexo'] == 'M' ? 'selected' : ''; ?>>Masculino</option>
                            <option value="F" <?php echo $data['sexo'] == 'F' ? 'selected' : ''; ?>>Femenino</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($data['email'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Número de Teléfono</label>
                        <input type="tel" id="telefono" name="telefono" value="<?php echo htmlspecialchars($data['telefono'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($data['direccion'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="calle_numero">Calle y Número</label>
                        <input type="text" id="calle_numero" name="calle_numero" value="<?php echo htmlspecialchars($data['calle_numero'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="colonia">Colonia</label>
                        <input type="text" id="colonia" name="colonia" value="<?php echo htmlspecialchars($data['colonia'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="ciudad">Ciudad</label>
                        <input type="text" id="ciudad" name="ciudad" value="<?php echo htmlspecialchars($data['ciudad'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <input type="text" id="estado" name="estado" value="<?php echo htmlspecialchars($data['estado'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="codigo_postal">Código Postal</label>
                        <input type="text" id="codigo_postal" name="codigo_postal" value="<?php echo htmlspecialchars($data['codigo_postal'] ?? ''); ?>">
                    </div>
                    <div class="button-container">
                        <button type="button" id="prevStep">Anterior</button>
                        <button type="button" id="nextStep">Siguiente</button>
                    </div>
                </div>

                <div id="step-3" class="step">
                    <h3>Paso 3: Educación y Experiencia</h3>
                    <div class="form-group">
                        <label for="institucion_academica">Institución Académica</label>
                        <input type="text" id="institucion_academica" name="institucion_academica" value="<?php echo htmlspecialchars($data['institucion_academica'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="grado_estudios">Grado de Estudios</label>
                        <input type="text" id="grado_estudios" name="grado_estudios" value="<?php echo htmlspecialchars($data['grado_estudios'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="nombre_carrera">Nombre de la Carrera</label>
                        <input type="text" id="nombre_carrera" name="nombre_carrera" value="<?php echo htmlspecialchars($data['nombre_carrera'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="experiencia_laboral">Experiencia Laboral</label>
                        <textarea id="experiencia_laboral" name="experiencia_laboral"><?php echo htmlspecialchars($data['experiencia_laboral'] ?? ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="experiencia_puesto">Experiencia en el Puesto Solicitado</label>
                        <textarea id="experiencia_puesto" name="experiencia_puesto"><?php echo htmlspecialchars($data['experiencia_puesto'] ?? ''); ?></textarea>
                    </div>
                    <div class="button-container">
                        <button type="button" id="prevStep">Anterior</button>
                        <button type="button" id="nextStep">Siguiente</button>
                    </div>
                </div>

                <div id="step-4" class="step">
                    <h3>Paso 4: Documentación y Otros Detalles</h3>
                    <div class="form-group">
                        <label for="documentacion">Documentación</label>
                        <input type="text" id="documentacion" name="documentacion" value="<?php echo htmlspecialchars($data['documentacion'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="tipo_licencia">Tipo de Licencia</label>
                        <input type="text" id="tipo_licencia" name="tipo_licencia" value="<?php echo htmlspecialchars($data['tipo_licencia'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="licencia_vigente">Licencia Vigente (Sí/No)</label>
                        <input type="text" id="licencia_vigente" name="licencia_vigente" value="<?php echo htmlspecialchars($data['licencia_vigente'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="referencias_personales">Referencias Personales</label>
                        <textarea id="referencias_personales" name="referencias_personales"><?php echo htmlspecialchars($data['referencias_personales'] ?? ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="observaciones">Observaciones</label>
                        <textarea id="observaciones" name="observaciones"><?php echo htmlspecialchars($data['observaciones'] ?? ''); ?></textarea>
                    </div>
                    <div class="button-container">
                        <button type="button" id="prevStep">Anterior</button>
                        <button type="submit" id="submitButton">Enviar</button>
                    </div>
                </div>
            <?php else: ?>
                <p>No se encontraron datos para mostrar.</p>
            <?php endif; ?>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let currentStep = 1;
        const totalSteps = 4; // Número total de pasos
        const steps = document.querySelectorAll('.step');

        function showStep(step) {
            steps.forEach((el, index) => {
                el.classList.toggle('active', index === step - 1);
            });
        }

        function updateButtons() {
            document.getElementById('prevStep').style.display = currentStep === 1 ? 'none' : 'inline-block';
            document.getElementById('nextStep').style.display = currentStep === totalSteps ? 'none' : 'inline-block';
        }

        showStep(currentStep);
        updateButtons();

        document.getElementById('nextStep').addEventListener('click', function () {
            if (currentStep < totalSteps) {
                currentStep++;
                showStep(currentStep);
                updateButtons();
            }
        });

        document.getElementById('prevStep').addEventListener('click', function () {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
                updateButtons();
            }
        });
    });
</script>
</body>
</html>
