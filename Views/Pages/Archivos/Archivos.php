<?php
$controller = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    // Verificar si no se ha seleccionado un archivo
    if ($_FILES['file']['error'] == UPLOAD_ERR_NO_FILE) {
        $controller = '
        <div class="alert alert-info border-0 d-flex align-items-center" role="alert">
            <div class="bg-info me-3 icon-item"><span class="fas fa-info-circle text-white fs-6"></span></div>
            <p class="mb-0 flex-1">Selecciona un archivo primero </p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    } else {
        // Validar tipo y tamaño del archivo aquí si es necesario
        $uploadResult = FileController::subirArchivo($_FILES['file'], $_SESSION['user_id']);
        $controller = $uploadResult;
    }
}

$delete_status = '';
if (isset($_POST['delete_id'])) {
    $delete_status = FileController::eliminarArchivo($_POST['delete_id']);
    echo '<script>window.location.href = "Archivos";</script>';
    exit;
}

// Obtener lista de archivos
$archivos = FileController::obtenerArchivosPorEmpleado($_SESSION['user_id']);
?>
<h2 id="file-manager-title" class="mt-3 mb-4">Gestor de Archivos</h2>
<form id="file-upload-form" enctype="multipart/form-data" method="POST" action="">
    <div class="mb-3">
        <input type="file" name="file" id="file" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Subir Archivo</button>
</form>
<?php if (!empty($controller)) : ?>
    <?php echo $controller; ?>
<?php endif; ?>
<?php if (!empty($delete_status)) : ?>
    <div class="alert alert-info"><?php echo htmlspecialchars($delete_status); ?></div>
<?php endif; ?>
<div class="table-responsive">
    <table id="file-table" class="table table-striped">
        <thead>
            <tr>
                <th class="text-900 sort">Nombre</th>
                <th class="text-900 sort">Tipo</th>
                <th class="text-900 sort">Fecha de Subida</th>
                <th class="text-900 sort">Acciones</th>
            </tr>
        </thead>
        <tbody id="file-table-body">
            <?php foreach ($archivos as $archivo) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($archivo['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($archivo['tipo']); ?></td>
                    <td><?php echo htmlspecialchars($archivo['fecha_subida']); ?></td>
                    <td class="file-action-buttons">
                        <a href="<?php echo htmlspecialchars($archivo['ruta']); ?>" class="btn btn-sm btn-secondary" download>Descargar</a>
                        <form action="" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este archivo?');">
                            <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($archivo['idArchivos']); ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                        <form action="" method="POST" style="display:inline;">
                            <input type="hidden" name="print" value="<?php echo htmlspecialchars($archivo['ruta']); ?>">
                            <button type="submit" class="btn btn-sm btn-secondary">Imprimir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php
if (isset($_POST['print'])) {
    $filePath = $_POST['print'];
    $extension = pathinfo($filePath, PATHINFO_EXTENSION);

    if ($extension === 'pdf') {
        echo "<iframe src='$filePath' style='display:none;' onload='this.contentWindow.print();'></iframe>";
    } else {
        echo "<script>
                var printWindow = window.open('$filePath', '_blank');
                printWindow.onload = function() {
                    printWindow.print();
                };
                </script>";
    }
}
?>


