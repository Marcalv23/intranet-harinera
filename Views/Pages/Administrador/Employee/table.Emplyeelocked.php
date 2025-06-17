<style>
    .alert-fixed {
        position: fixed;
        top: 60px;
        right: 20px;
        z-index: 9999;
        width: 400px;
        opacity: 1;
        transition: opacity 0.5s ease;
    }
</style>
<?php
// Verifica si se ha solicitado bloquear un empleado
if (isset($_GET['action']) && $_GET['action'] === 'block' && isset($_GET['idEmpleado'])) {
    $idEmpleado = $_GET['idEmpleado'];

    // Llama al método para bloquear el empleado
    try {
        EmployeeController::unlockEmployee($idEmpleado);
        echo
        '<div id="alertBlock" class="alert-fixed alert alert-success border-0 d-flex align-items-center" role="alert">
            <div class="bg-success me-3 icon-item"><span class="fas fa-check-circle text-white fs-6"></span></div>
            <p class="mb-0 flex-1">El usuario ha sido desbloqueado correctamente.</p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    } catch (Exception $e) {
        echo
        '<div id="alertBlock" class="alert-fixed alert alert-danger border-0 d-flex align-items-center alert-fixed" role="alert">
            <div class="bg-danger me-3 icon-item"><span class="fas fa-times-circle text-white fs-6"></span></div>
            <p class="mb-0 flex-1">Error al desbloquear al usuario: ' . $e->getMessage() . '</p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['idEmpleado'])) {
    $idEmpleado = $_GET['idEmpleado'];

    // Llama al método para eliminar el empleado
    try {
        EmployeeController::deleteEmployee($idEmpleado);
        echo '
        <div id="alertBlock" class="alert-fixed alert alert-success border-0 d-flex align-items-center" role="alert">
            <div class="bg-success me-3 icon-item"><span class="fas fa-check-circle text-white fs-6"></span></div>
            <p class="mb-0 flex-1">El usuario ha sido eliminado correctamente.</p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    } catch (Exception $e) {
        echo '
        <div id="alertBlock" class="alert-fixed alert alert-danger border-0 d-flex align-items-center alert-fixed" role="alert">
            <div class="bg-danger me-3 icon-item"><span class="fas fa-times-circle text-white fs-6"></span></div>
            <p class="mb-0 flex-1">Error al eliminar al usuario: ' . $e->getMessage() . '</p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}
?>
<div id="tableExample3" class="mt-5" data-list='{"valueNames":["foto","name","email","tel","dep","rol","No"],"page":10,"pagination":true}'>
    <div class="tab-content">
        <div class="row justify-content g-0">
            <div class="col-auto col-sm-5">
                <form class="mt-4">
                    <div class="input-group"><input class="form-control form-control-sm shadow-none search" type="search" placeholder="Search..." aria-label="search" />
                        <div class="input-group-text bg-transparent"><span class="fa fa-search fs-10 text-600"></span></div>
                    </div>
                </form>
            </div>
            <div class="d-flex align-items-center justify-content-end my-3">
                <a href="Empleados"><button class="btn btn-falcon-primary btn-sm me-2" type="button"><span class="fas fa-lock-open" data-fa-transform="shrink-3 down-2"></span><span class="ms-1">Activos</span></button></a>
            </div>
        </div>
        <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="activos-tab">
            <div class="table-responsive scrollbar">
                <table class="table table-bordered table-striped fs-10 mb-0">
                    <thead class="bg-300">
                        <tr>
                            <th class="text-900 sort" data-sort="foto">Foto</th>
                            <th class="text-900 sort" data-sort="name">Nombre</th>
                            <th class="text-900 sort" data-sort="email">Correo</th>
                            <th class="text-900 sort" data-sort="tel">Telefono</th>
                            <th class="text-900 sort" data-sort="dep">Departamento</th>
                            <th class="text-900 sort" data-sort="rol">Rol</th>
                            <th class="text-900 sort" data-sort="No">No.Empleado</th>
                            <th></th>
                            <th class="text-900 sort">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php
                        try {
                            $usuarios = EmployeeController::getUsersInactive();
                            if (!empty($usuarios)) {
                                foreach ($usuarios as $usuario) {
                        ?>
                                    <tr>
                                        <td>
                                            <div class="avatar avatar-l me-2 foto">
                                                <img class="rounded-circle" src="<?php echo htmlspecialchars('./Views/Resources/img/' . $usuario['foto']); ?>" alt="Foto de <?php echo htmlspecialchars($usuario['nombreEmpleado']); ?>" />
                                            </div>
                                        </td>
                                        <td class="name">
                                            <a href="Perfil?noEmpleado=<?php echo htmlspecialchars($usuario['noEmpleado']); ?>">
                                                <?php echo htmlspecialchars($usuario['nombreEmpleado'] . ' ' . $usuario['apellidoPaterno'] . ' ' . $usuario['apellidoMaterno']); ?>
                                            </a>
                                        </td>
                                        <td class="email"><?php echo htmlspecialchars($usuario['emailEmpleado']); ?></td>
                                        <td class="tel"><?php echo htmlspecialchars($usuario['telefono']); ?></td>
                                        <td class="dep"><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                                        <td class="rol"><?php echo htmlspecialchars($usuario['rol']); ?></td>
                                        <td class="No"><?php echo htmlspecialchars($usuario['noEmpleado']); ?></td>
                                        <td><a href="#">Editar permisos</a></td>
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#ModalDesbloquear<?php echo htmlspecialchars($usuario['idEmpleado']); ?>">
                                                    <span class=" fas fa-lock-open"></span>
                                                </a>
                                                <a class="btn btn-danger me-1" data-bs-toggle="modal" data-bs-target="#ModalEliminar<?php echo htmlspecialchars($usuario['idEmpleado']); ?>">
                                                    <span class="far fa-trash-alt"></span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                        <?php
                                }
                            } else {
                                echo "<tr><td colspan='10'>No se encontraron registros.</td></tr>";
                            }
                        } catch (Exception $e) {
                            // Manejo de errores: Muestra un mensaje amigable al usuario
                            echo '<tr><td colspan="10">Error al obtener empleados activos: ' . $e->getMessage() . '</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3"><button class="btn btn-sm btn-falcon-default me-1" type="button" title="Previous" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
                <ul class="pagination mb-0"></ul><button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next" data-list-pagination="next"><span class="fas fa-chevron-right"> </span></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmación para Activar usuario -->
<?php foreach ($usuarios as $usuario) : ?>
    <div class="modal fade" id="ModalDesbloquear<?php echo htmlspecialchars($usuario['idEmpleado']); ?>" tabindex="-1" aria-labelledby="ModalDesbloquearLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalDesbloquearLabel">Confirmar Acción</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de desbloquear a <?php echo htmlspecialchars($usuario['nombreEmpleado']); ?>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="?action=block&idEmpleado=<?php echo htmlspecialchars($usuario['idEmpleado']); ?>">
                        <button type="button" class="btn btn-primary">Desbloquear</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ModalEliminar<?php echo htmlspecialchars($usuario['idEmpleado']); ?>" tabindex="-1" aria-labelledby="ModalEliminarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEliminarLabel">Confirmar Acción</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de eliminar a <?php echo htmlspecialchars($usuario['nombreEmpleado']); ?>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="?action=delete&idEmpleado=<?php echo htmlspecialchars($usuario['idEmpleado']); ?>" class="btn btn-danger">Eliminar</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<script src="Views/Resources/assets/js/alerts.js"></script>