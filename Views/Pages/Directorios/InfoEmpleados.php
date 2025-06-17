<?php
$noEmpleado = isset($_GET['noEmpleado']) ? $_GET['noEmpleado'] : '';

if ($noEmpleado) {
    $controller = new EmployeeController();
    $empleado = $controller->getEmployee($noEmpleado);

    if (!$empleado) {
        // Si no se encuentra el empleado, mostrar un mensaje de error
        echo '<div class="container mt-5">';
        echo '<div class="alert alert-danger" role="alert">';
        echo 'El empleado no fue encontrado.';
        echo '</div>';
        echo '</div>';
    } else {
        // Si se encontró el empleado, mostrar los detalles
?>
        <div class="container mt-5">
            <div class="card">
                <div class="card-header bg-primary text-light">
                    <h3 class="mb-0 text-light">Detalles del <?php echo htmlspecialchars($empleado['rol']); ?></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <div style="width: 150px; height: 150px; overflow: hidden; border-radius: 50%; border: 4px solid #ccc; margin: 0 auto;">
                                <img class="rounded-circle" src="<?php echo htmlspecialchars('./Views/Resources/img/' . $empleado['foto']); ?>" alt="Foto de <?php echo htmlspecialchars($empleado['nombreEmpleado']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <h5 class="mt-3"><?php echo htmlspecialchars($empleado['nombreEmpleado']); ?></h5>
                            <p class="text-muted"><?php echo htmlspecialchars($empleado['tipoEmpleado']); ?></p>
                        </div>
                        <div class="col-md-9">
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <p><strong>ID Empleado:</strong> <?php echo htmlspecialchars($empleado['idEmpleado']); ?></p>
                                    <p><strong>Email:</strong> <?php echo htmlspecialchars($empleado['emailEmpleado']); ?></p>
                                    <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($empleado['telefono']); ?></p>
                                    <p><strong>Fecha de Nacimiento:</strong> <?php echo date('d M Y', strtotime($empleado['fechaNacimiento'])); ?></p>
                                    <p><strong>Género:</strong> <?php echo htmlspecialchars($empleado['genero']); ?></p>
                                    <p><strong>Estado:</strong> <?php echo htmlspecialchars($empleado['estado']); ?></p>
                                    <p><strong>Ciudad:</strong> <?php echo htmlspecialchars($empleado['ciudad']); ?></p>
                                </div>
                                <div class="col-sm-6">
                                    <p><strong>Fecha de Contratación:</strong> <?php echo date('d M Y', strtotime($empleado['fechaContratacion'])); ?></p>
                                    <p><strong>Salario:</strong> $ <?php echo number_format($empleado['salario'], 2, '.', ','); ?></p>
                                    <p><strong>No. Empleado:</strong> <?php echo htmlspecialchars($empleado['noEmpleado']); ?></p>
                                    <p><strong>RFC:</strong> <?php echo htmlspecialchars($empleado['rfc']); ?></p>
                                    <p><strong>Número de Seguro Social:</strong> <?php echo htmlspecialchars($empleado['numeroSeguroSocial']); ?></p>
                                    <p><strong>Departamento:</strong> <?php echo htmlspecialchars($empleado['nombre']); ?></p>
                                    <p><strong>Rol:</strong> <?php echo htmlspecialchars($empleado['rol']); ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p><strong>Dirección:</strong> <?php echo htmlspecialchars($empleado['direccion']); ?></p>
                                    <p><strong>Código Postal:</strong> <?php echo htmlspecialchars($empleado['codigoPostal']); ?></p>
                                    <p><strong>País:</strong> <?php echo htmlspecialchars($empleado['pais']); ?></p>
                                </div>
                                <div class="col">
                                    <p><strong>Estado Empleado:</strong> <?php echo htmlspecialchars($empleado['estadoEmpleado']); ?></p>
                                    <p><strong>Tipo Snage:</strong> <?php echo htmlspecialchars($empleado['tipoSnage']); ?></p>
                                    <p><strong>Fecha Última Actividad:</strong> <?php echo htmlspecialchars($empleado['fechaUltimaActividad']); ?></p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <p><strong>Notas:</strong> <?php echo htmlspecialchars($empleado['notas']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
} else {
    // Si no se proporcionó un número de empleado válido, mostrar un mensaje de error
    echo '<div class="container mt-5">';
    echo '<div class="alert alert-danger" role="alert">';
    echo 'No se proporcionó un número de empleado válido.';
    echo '</div>';
    echo '</div>';
}
?>