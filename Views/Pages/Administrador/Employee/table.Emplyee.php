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
        EmployeeController::blockEmployee($idEmpleado);
        echo
        '<div id="alertBlock" class="alert-fixed alert alert-success border-0 d-flex align-items-center" role="alert">
            <div class="bg-success me-3 icon-item"><span class="fas fa-check-circle text-white fs-6"></span></div>
            <p class="mb-0 flex-1">El usuario ha sido bloqueado correctamente.</p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    } catch (Exception $e) {
        echo
        '<div id="alertBlock" class="alert-fixed alert alert-danger border-0 d-flex align-items-center alert-fixed" role="alert">
            <div class="bg-danger me-3 icon-item"><span class="fas fa-times-circle text-white fs-6"></span></div>
            <p class="mb-0 flex-1">Error al bloquear al usuario: ' . $e->getMessage() . '</p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}
?>
<div id="tableExample3" data-list='{"valueNames":["foto","name","email","tel","dep","rol","No"],"page":10,"pagination":true}'>
    <div class="row justify-content-end g-0 mt-4">
        <ul class="nav nav-tabs mb-1" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="activos-tab" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">
                    Colaboradores</button>
            </li>
            <li class="nav-item" role="presentation">
                <a href="Proveedores">
                    <button class="nav-link" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">
                        Proveedores</button>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="Clientes">
                    <button class="nav-link" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">
                        Clientes</button>
                </a>
            </li>
        </ul>
    </div>
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
                <a href="EmpleadosBloqueados"><button class="btn btn-falcon-danger btn-sm me-2" type="button"><span class="fas fa-lock" data-fa-transform="shrink-3 down-2"></span><span class="ms-1">Bloqueados</span></button></a>
                <div data-bs-target="#agregar" data-bs-toggle="modal"><button class="btn btn-falcon-success btn-sm" type="button"><span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span><span class="ms-1">Agregar</span></button></div>
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
                            $usuarios = EmployeeController::getUsersActive();
                            if (!empty($usuarios)) {
                                foreach ($usuarios as $usuario) {
                        ?>
                                    <tr>
                                        <td>
                                            <div class="avatar avatar-l me-2 foto">
                                                <img class="rounded-circle" src="<?php echo htmlspecialchars('./Views/Resources/img/' . $usuario['foto']); ?>" />
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
                                                <a class="btn btn-info me-2 btn-actualizar" data-bs-toggle="modal" data-bs-target="#update" data-id="<?php echo htmlspecialchars($usuario['idEmpleado']); ?>">
                                                    <span class="fas fa-sync-alt"></span>
                                                </a>
                                                <a class="btn btn-warning me-3" data-bs-toggle="modal" data-bs-target="#confirmacionModal<?php echo htmlspecialchars($usuario['idEmpleado']); ?>">
                                                    <span class="fas fa-lock"></span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                        <?php
                                }
                            } else {
                                echo "<tr><td colspan='9'>No se encontraron registros.</td></tr>";
                            }
                        } catch (Exception $e) {
                            // Manejo de errores: Muestra un mensaje amigable al usuario
                            echo '<tr><td colspan="9">Error al obtener empleados activos: ' . $e->getMessage() . '</td></tr>';
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

<!-- Modal de confirmación para bloquear usuario -->
<?php foreach ($usuarios as $usuario) : ?>
    <div class="modal fade" id="confirmacionModal<?php echo htmlspecialchars($usuario['idEmpleado']); ?>" tabindex="-1" aria-labelledby="confirmacionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmacionModalLabel">Confirmar Acción</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de bloquear a <?php echo htmlspecialchars($usuario['nombreEmpleado']); ?>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="?action=block&idEmpleado=<?php echo htmlspecialchars($usuario['idEmpleado']); ?>">
                        <button type="button" class="btn btn-warning">Bloquear</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!--  Modal para insertar un usuario nuevo-->
<div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="agregarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="row text-start justify-content-between align-items-center mb-2">
                    <div class="col-auto">
                        <h5 id="agregarModalLabel">Nuevo Colaborador</h5>
                    </div>
                    <button class="btn-close mb-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?php EmployeeController::postInsertColaboradores() ?>
                <form action="" method="post">
                    <input value="Activo" name="estadoEmpleado" type="hidden">
                    <div class="mb-3">
                        <input class="form-control" type="text" name="nombreEmpleado" placeholder="Nombre" required />
                    </div>
                    <div class="row gx-1 mb-3">
                        <div class="col-sm-6 mb-1">
                            <input class="form-control" type="text" name="apellidoPaterno" placeholder="Apellido Paterno" required />
                        </div>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="apellidoMaterno" placeholder="Apellido Materno" required />
                        </div>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="email" name="emailEmpleado" placeholder="Correo" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Por favor ingresa un correo electrónico válido" required />
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="password" name="hashed_password" placeholder="Contraseña" required />
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="tel" name="telefono" placeholder="Telefono" pattern="[0-9]+" title="ingresa solo números" required />
                    </div>

                    <div class="mb-3">
                        <label for="fechaNacimiento">Fecha de nacimiento<span class="text-danger"> *</span></label>
                        <input class="form-control" type="date" name="fechaNacimiento" required />
                    </div>

                    <div class="mb-3">
                        <label for="genero">Genero<span class="text-danger"> *</span></label>
                        <select class="form-select" name="genero">
                            <option>--Seleccione--</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                            <option value="Otro">Prefiero no decirlo</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="pais" placeholder="Pais" required />
                    </div>
                    <div class="row gx-1 mb-3">
                        <div class="col-sm-6 mb-1">
                            <input class="form-control" type="text" name="estado" placeholder="Estado" required />
                        </div>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="ciudad" placeholder="Ciudad" required />
                        </div>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="direccion" placeholder="Direccion" required />
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="codigoPostal" placeholder="Codigo Postal" required />
                    </div>
                    <div class="mb-3">
                        <label for="fechaContratacion">Fecha de contratacion<span class="text-danger"> *</span></label>
                        <input class="form-control" type="date" name="fechaContratacion" required />
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="number" name="salario" placeholder="Salario" required />
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="noEmpleado" placeholder="No. Empleado" required />
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="numeroSeguroSocial" placeholder="No. Seguridad social" required />
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="rfc" placeholder="RFC" required />
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="notas" placeholder="Notas"></textarea>
                    </div>
                    <div class="row gx-1 mb-3">
                        <div class="col-sm-6 mt-1">
                            <select class="form-select" name="idRol" required>
                                <option>-- Rol --</option>
                                <?php
                                $roles = EmployeeController::getRoles();

                                if (!empty($roles)) {
                                    foreach ($roles as $rol) {
                                ?>
                                        <option value="<?php echo htmlspecialchars($rol['idRol']); ?>"><?php echo htmlspecialchars($rol['nombre']); ?></option>
                                <?php
                                    }
                                } else {
                                    echo "<option disabled>No se encontraron roles</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-6 mt-1">
                            <select class="form-select" name="idDepartamento" required>
                                <option>--Departamento--</option>
                                <?php
                                $departamento = EmployeeController::getdepartamento();

                                if (!empty($departamento)) {
                                    foreach ($departamento as $dep) {
                                ?>
                                        <option value="<?php echo htmlspecialchars($dep['idDepto']); ?>"><?php echo htmlspecialchars($dep['nombre']); ?></option>
                                <?php
                                    }
                                } else {
                                    echo "<option disabled>No se encontraron departamentos</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row gx-1 mb-3">
                        <hr>
                        <div class="col-sm-6 mb-1">
                            <button class="btn btn-primary d-block mx-1 w-100" type="submit" name="registrar">Agregar</button>
                        </div>
                        <div class="col-sm-6">
                            <button class="btn btn-secondary d-block mx-1 w-100" type="reset">Restaurar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal para Actualizar Usuarios -->
<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="row text-start justify-content-between align-items-center mb-2">
                    <div class="col-auto">
                        <h5 id="updateModalLabel">Actualizar Colaborador</h5>
                    </div>
                    <button class="btn-close mb-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?php EmployeeController::postUpdateColaborador() ?>
                <form action="" method="post">
                    <input type="hidden" name="idEmpleado" id="idEmpleado_update" />
                    <div class="mb-1">
                        <label for="nombreEmpleado">Nombre<span class="text-danger"> *</span></label>
                        <input class="form-control" type="text" name="nombreEmpleado" id="nombreEmpleado_update" placeholder="Nombre" required />
                    </div>
                    <div class="row gx-1 mb-1">
                        <div class="col-sm-6 mb-1">
                            <label for="apellidoPaterno">Apellido paterno<span class="text-danger"> *</span></label>
                            <input class="form-control" type="text" name="apellidoPaterno" id="apellidoPaterno_update" placeholder="Apellido Paterno" required />
                        </div>
                        <div class="col-sm-6">
                            <label for="apellidoMaterno">Apellido materno<span class="text-danger"> *</span></label>
                            <input class="form-control" type="text" name="apellidoMaterno" id="apellidoMaterno_update" placeholder="Apellido Materno" required />
                        </div>
                    </div>
                    <div class="mb-1">
                        <label for="emailEmpleado">Email<span class="text-danger"> *</span></label>
                        <input class="form-control" type="email" name="emailEmpleado" id="emailEmpleado_update" placeholder="Correo" required />
                    </div>
                    <div class="mb-1">
                        <label for="hashed_password">Contraseña<span class="text-danger"> *</span></label>
                        <input class="form-control" type="password" name="hashed_password" id="hashed_password_update" placeholder="Contraseña" />
                        <small class="text-muted">Deja este campo en blanco para mantener la contraseña actual.</small>
                    </div>
                    <div class="mb-1">
                        <label for="telefono">Telefono<span class="text-danger"> *</span></label>
                        <input class="form-control" type="tel" name="telefono" id="telefono_update" placeholder="Telefono" pattern="[0-9]+" title="ingresa solo números" required />
                    </div>

                    <div class="mb-1">
                        <label for="fechaNacimiento">Fecha de nacimiento<span class="text-danger"> *</span></label>
                        <input class="form-control" type="date" name="fechaNacimiento" id="fechaNacimiento_update" required />
                    </div>

                    <div class="mb-1">
                        <label for="genero">Genero<span class="text-danger"> *</span></label>
                        <select class="form-select" id="genero_update" name="genero">
                            <option>--Seleccione--</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                            <option value="Otro">Prefiero no decirlo</option>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label for="pais">País<span class="text-danger"> *</span></label>
                        <input class="form-control" type="text" name="pais" id="pais_update" placeholder="Pais" required />
                    </div>
                    <div class="row gx-1 mb-2">
                        <div class="col-sm-6 mb-1">
                            <label for="estado">Estado<span class="text-danger"> *</span></label>
                            <input class="form-control" type="text" name="estado" id="estado_update" placeholder="Estado" required />
                        </div>
                        <div class="col-sm-6">
                            <label for="ciudad">Ciudad<span class="text-danger"> *</span></label>
                            <input class="form-control" type="text" name="ciudad" id="ciudad_update" placeholder="Ciudad" required />
                        </div>
                    </div>
                    <div class="mb-1">
                        <label for="direccion">Dirección<span class="text-danger"> *</span></label>
                        <input class="form-control" type="text" name="direccion" id="direccion_update" placeholder="Direccion" required />
                    </div>
                    <div class="mb-1">
                        <label for="codigoPostal">Codigo Postal<span class="text-danger"> *</span></label>
                        <input class="form-control" type="text" name="codigoPostal" id="codigoPostal_update" placeholder="Codigo Postal" required />
                    </div>
                    <div class="mb-1">
                        <label for="fechaContratacion">Fecha de contratacion<span class="text-danger"> *</span></label>
                        <input class="form-control" type="date" name="fechaContratacion" id="fechaContratacion_update" required />
                    </div>
                    <div class="mb-1">
                        <label for="salario">Salario<span class="text-danger"> *</span></label>
                        <input class="form-control" type="number" name="salario" id="salario_update" placeholder="Salario" required />
                    </div>
                    <div class="mb-1">
                        <label for="noEmpleado">No. Empleado<span class="text-danger"> *</span></label>
                        <input class="form-control" type="text" name="noEmpleado" id="noEmpleado_update" placeholder="No. Empleado" required />
                    </div>
                    <div class="mb-1">
                        <label for="numeroSeguroSocial">Seguro social<span class="text-danger"> *</span></label>
                        <input class="form-control" type="text" name="numeroSeguroSocial" id="numeroSeguroSocial_update" placeholder="No. Seguridad social" required />
                    </div>
                    <div class="mb-1">
                        <label for="rfc">RFC<span class="text-danger"> *</span></label>
                        <input class="form-control" type="text" name="rfc" id="rfc_update" placeholder="RFC" required />
                    </div>
                    <div class="mb-1">
                        <label for="notas">Notas<span class="text-danger"> *</span></label>
                        <textarea class="form-control" name="notas" id="notas_update" placeholder="Notas"></textarea>
                    </div>
                    <div class="row gx-1 mb-3">
                        <div class="col-sm-6 mt-1">
                            <label for="idRol">Rol<span class="text-danger"> *</span></label>
                            <select class="form-select" id="idRol_update" name="idRol" required>
                                <option>-- Rol --</option>
                                <?php
                                if (!empty($roles)) {
                                    foreach ($roles as $rol) {
                                ?>
                                        <option value="<?php echo htmlspecialchars($rol['idRol']); ?>"><?php echo htmlspecialchars($rol['nombre']); ?></option>
                                <?php
                                    }
                                } else {
                                    echo "<option disabled>No se encontraron roles</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-6 mt-1">
                            <label for="idDepartamento">Departamento<span class="text-danger"> *</span></label>
                            <select class="form-select" id="idDepartamento_update" name="idDepartamento" required>
                                <option>-- Departamento --</option>
                                <?php
                                if (!empty($departamento)) {
                                    foreach ($departamento as $dep) {
                                ?>
                                        <option value="<?php echo htmlspecialchars($dep['idDepto']); ?>"><?php echo htmlspecialchars($dep['nombre']); ?></option>
                                <?php
                                    }
                                } else {
                                    echo "<option disabled>No se encontraron roles</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row gx-1 mb-3">
                        <hr>
                        <div class="col-sm-6 mb-1">
                            <button class="btn btn-primary d-block mx-1 w-100" type="submit" name="actualizar">Actualizar</button>
                        </div>
                        <div class="col-sm-6">
                            <button class="btn btn-secondary d-block mx-1 w-100" type="reset">Restaurar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtener todos los botones de actualización
        var updateButtons = document.querySelectorAll('.btn-actualizar');

        // Iterar sobre cada botón de actualización
        updateButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevenir el comportamiento por defecto del enlace

                var userId = this.getAttribute('data-id'); // Obtener el id del usuario

                // Hacer una solicitud AJAX para obtener los datos del usuario
                fetch('Models/BLobtain.php?action=ObtainColab&id=' + userId)
                    .then(response => response.json())
                    .then(data => {
                        // Llenar los campos del formulario con los datos obtenidos
                        document.getElementById('idEmpleado_update').value = data.idEmpleado;
                        document.getElementById('nombreEmpleado_update').value = data.nombreEmpleado;
                        document.getElementById('apellidoPaterno_update').value = data.apellidoPaterno;
                        document.getElementById('apellidoMaterno_update').value = data.apellidoMaterno;
                        document.getElementById('emailEmpleado_update').value = data.emailEmpleado;
                        document.getElementById('telefono_update').value = data.telefono;
                        document.getElementById('fechaNacimiento_update').value = formatDate(data.fechaNacimiento);
                        document.getElementById('genero_update').value = data.genero;
                        document.getElementById('pais_update').value = data.pais;
                        document.getElementById('estado_update').value = data.estado;
                        document.getElementById('ciudad_update').value = data.ciudad;
                        document.getElementById('direccion_update').value = data.direccion;
                        document.getElementById('codigoPostal_update').value = data.codigoPostal;
                        document.getElementById('fechaContratacion_update').value = formatDate(data.fechaContratacion);
                        document.getElementById('salario_update').value = data.salario;
                        document.getElementById('noEmpleado_update').value = data.noEmpleado;
                        document.getElementById('numeroSeguroSocial_update').value = data.numeroSeguroSocial;
                        document.getElementById('rfc_update').value = data.rfc;
                        document.getElementById('notas_update').value = data.notas;
                        document.getElementById('idRol_update').value = data.idRol;
                        document.getElementById('idDepartamento_update').value = data.idDepartamento;
                    })
                    .catch(error => console.error('Error al obtener datos del usuario', error));
            });
        });

        function formatDate(dateString) {
            if (!dateString) return '';

            // Convertir la fecha al formato YYYY-MM-DD si no está en ese formato
            var dateObject = new Date(dateString);
            if (isNaN(dateObject.getTime())) {
                // Si no es una fecha válida, retornar la cadena original
                return dateString;
            } else {
                // Convertir la fecha al formato YYYY-MM-DD
                var year = dateObject.getUTCFullYear();
                var month = ('0' + (dateObject.getUTCMonth() + 1)).slice(-2);
                var day = ('0' + dateObject.getUTCDate()).slice(-2);

                return year + '-' + month + '-' + day;
            }
        }
    });
</script>
<script src="Views/Resources/assets/js/alerts.js"></script>