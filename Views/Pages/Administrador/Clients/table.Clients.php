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
if (isset($_GET['action']) && $_GET['action'] === 'block' && isset($_GET['idCliente'])) {
    $idCliente = $_GET['idCliente'];

    // Llama al método para bloquear el empleado
    try {
        ClientsController::blockclient($idCliente);
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
<div id="tableExample3" data-list='{"valueNames":["foto","name","estado","ciudad","CP","fechare","fecha"],"page":10,"pagination":true}'>
    <div class="row justify-content-end g-0 mt-4">
        <ul class="nav nav-tabs mb-1" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a href="Empleados">
                    <button class="nav-link" id="activos-tab" data-bs-toggle="tab" data-bs-target="#activos" type="button" role="tab" aria-controls="activos" aria-selected="true">
                        Colaboradores</button>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="Proveedores">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#bloqueados" type="button" role="tab" aria-controls="bloqueados" aria-selected="false">
                        Proveedores</button>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="Clientes">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#bloqueados" type="button" role="tab" aria-controls="bloqueados" aria-selected="false">
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
                <a href="ClientesBloqueados"><button class="btn btn-falcon-danger btn-sm me-2" type="button"><span class="fas fa-lock" data-fa-transform="shrink-3 down-2"></span><span class="ms-1">Bloqueados</span></button></a>
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
                            <th class="text-900 sort" data-sort="estado">Estado</th>
                            <th class="text-900 sort" data-sort="ciudad">Ciudad</th>
                            <th class="text-900 sort" data-sort="CP">Codigo Postal</th>
                            <th class="text-900 sort" data-sort="fechare">Registro</th>
                            <th class="text-900 sort" data-sort="fecha">Fecha de ultima Actividad</th>
                            <th></th>
                            <th class="text-900 sort">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php
                        try {
                            $usuarios = ClientsController::getUsersActive();
                            if (!empty($usuarios)) {
                                foreach ($usuarios as $usuario) {
                        ?>
                                    <tr>
                                        <td class="foto"><?php echo htmlspecialchars($usuario['foto']); ?></td>
                                        <td class="name">
                                            <a href="Cliente?idCliente=<?php echo htmlspecialchars($usuario['idCliente']); ?>">
                                                <?php echo htmlspecialchars($usuario['nombreCliente'] . ' ' . $usuario['apellidoPaterno'] . ' ' . $usuario['apellidoMaterno']); ?>
                                            </a>
                                        </td>
                                        <td class="estado"><?php echo htmlspecialchars($usuario['estado']); ?></td>
                                        <td class="ciudad"><?php echo htmlspecialchars($usuario['ciudad']); ?></td>
                                        <td class="CP"><?php echo htmlspecialchars($usuario['codigoPostal']); ?></td>
                                        <td class="fechare"><?php echo htmlspecialchars($usuario['fechaRegistro']); ?></td>
                                        <td class="fecha"><?php echo htmlspecialchars($usuario['fechaUltimaActividad']); ?></td>
                                        <td><a href="">Editar permisos</a></td>
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-info me-2 btn-actualizar" data-bs-target="#update" data-bs-toggle="modal" data-id="<?php echo htmlspecialchars($usuario['idCliente']); ?>">
                                                    <span class="fas fa-sync-alt"></span>
                                                </a>
                                                <a class="btn btn-warning me-4" data-bs-toggle="modal" data-bs-target="#bloquearModal<?php echo htmlspecialchars($usuario['idCliente']); ?>">
                                                    <span class="fas fa-lock"></span>
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
<!-- Alert para confirmar si es neceario bloquear a l usuario-->
<?php foreach ($usuarios as $usuario) : ?>
    <div class="modal fade" id="bloquearModal<?php echo htmlspecialchars($usuario['idCliente']); ?>" tabindex="-1" aria-labelledby="bloquearModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bloquearModalLabel">Confirmar Acción</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de bloquear a <?php echo htmlspecialchars($usuario['nombreCliente']); ?>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="?action=block&idCliente=<?php echo htmlspecialchars($usuario['idCliente']); ?>">
                        <button type="button" class="btn btn-warning">Bloquear</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?php
// Establecer la zona horaria a México
date_default_timezone_set('America/Mexico_City');
?>
<!--  Modal para insertar un usuario nuevo-->
<div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="agregarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="row text-start justify-content-between align-items-center mb-2">
                    <div class="col-auto">
                        <h5 id="agregarModalLabel">Nuevo Cliente</h5>
                    </div>
                </div>
                <?php ClientsController::postInsertClientes() ?>
                <form action="" method="post">
                    <input value="Activo" type="hidden" name="estadoCuenta">
                    <div class="mb-3">
                        <input class="form-control" type="text" name="foto" placeholder="foto" required />
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="nombre" placeholder="Nombre" required />
                    </div>
                    <div class="row gx-1 mb-2">
                        <div class="col-sm-6 mb-1">
                            <input class="form-control" type="text" name="apellidoPaterno" placeholder="Apellido Paterno" required />
                        </div>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="apellidoMaterno" placeholder="Apellido Materno" required />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="fechaNacimiento">Fecha de nacimiento<span class="text-danger"> *</span></label>
                        <input class="form-control" type="date" name="fechaNacimiento" required />
                    </div>
                    <div class="row gx-1 mb-2">
                        <div class="col-sm-6 mb-1">
                            <input class="form-control" type="text" name="pais" placeholder="País" required />
                        </div>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="estado" placeholder="Estado" required />
                        </div>
                    </div>
                    <div class="row gx-1 mb-3">
                        <div class="col-sm-6 mb-1">
                            <input class="form-control" type="text" name="ciudad" placeholder="Ciudad" required />
                        </div>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="codigoPostal" placeholder="Codigo Postal" required />
                        </div>
                    </div>
                    <div class="mb-2">
                        <input class="form-control" type="text" name="direccion" placeholder="Dirección" required />
                    </div>
                    <div class="mb-3">
                        <label for="fechaRegistro">Fecha y hora de registro<span class="text-danger"> *</span></label>
                        <input class="form-control" type="datetime-local" name="fechaRegistro" value="<?php echo date('Y-m-d\TH:i'); ?>" required />
                    </div>

                    <div class="row gx-1 mb-2">
                        <div class="col-sm-6 mb-1">
                            <select class="form-select" name="tipoCliente">
                                <option>-- Tipo de cliente --</option>
                                <option value="opcion 1">opcion 1</option>
                                <option value="opcion 2">opcion 2</option>
                                <option value="opcion 3">opcion 3</option>
                            </select>
                        </div>
                        <div class="col-sm-6 mb-1">
                            <select class="form-select" name="preferencia">
                                <option>-- Preferencia --</option>
                                <option value="Alta">Alta</option>
                                <option value="Media">Media</option>
                                <option value="Baja">Baja</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-2">
                        <textarea class="form-control" name="informacion" placeholder="Informacion del cliente"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="contratacion">Fecha de ultima actividad<span class="text-danger"> *</span></label>
                        <input class="form-control" type="date" name="fechaUltimaActividad" required />
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="notas" placeholder="Notas"></textarea>
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

<!--  Modal para Actualizar un usuario nuevo-->
<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="row text-start justify-content-between align-items-center mb-2">
                    <div class="col-auto">
                        <h5 id="updateModalLabel">Actualizar Cliente</h5>
                    </div>
                    <button class="btn-close mb-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?php ClientsController::postUpdateClient() ?>
                <form action="" method="post">
                    <input type="hidden" name="idCliente" id="idCliente_update">
                    <div class="mb-3">
                        <input class="form-control" type="text" name="foto" id="foto_update" placeholder="foto" required />
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="nombreCliente" id="nombreCliente_update" placeholder="Nombre" required />
                    </div>
                    <div class="row gx-1 mb-2">
                        <div class="col-sm-6 mb-1">
                            <input class="form-control" type="text" name="apellidoPaterno" id="apellidoPaterno_update" placeholder="Apellido Paterno" required />
                        </div>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="apellidoMaterno" id="apellidoMaterno_update" placeholder="Apellido Materno" required />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="fechaNacimiento">Fecha de nacimiento<span class="text-danger"> *</span></label>
                        <input class="form-control" type="date" name="fechaNacimiento" id="fechaNacimiento_update" required />
                    </div>
                    <div class="row gx-1 mb-2">
                        <div class="col-sm-6 mb-1">
                            <input class="form-control" type="text" name="pais" id="pais_update" placeholder="País" required />
                        </div>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="estado" id="estado_update" placeholder="Estado" required />
                        </div>
                    </div>
                    <div class="row gx-1 mb-3">
                        <div class="col-sm-6 mb-1">
                            <input class="form-control" type="text" name="ciudad" id="ciudad_update" placeholder="Ciudad" required />
                        </div>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="codigoPostal" id="codigoPostal_update" placeholder="Codigo Postal" required />
                        </div>
                    </div>
                    <div class="mb-2">
                        <input class="form-control" type="text" name="direccion" id="direccion_update" placeholder="Dirección" required />
                    </div>
                    <div class="row gx-1 mb-2">
                        <div class="col-sm-6 mb-1">
                            <select class="form-select" name="tipoCliente" id="tipoCliente_update">
                                <option>-- Tipo de cliente --</option>
                                <option value="opcion 1">opcion 1</option>
                                <option value="opcion 2">opcion 2</option>
                                <option value="opcion 3">opcion 3</option>
                            </select>
                        </div>
                        <div class="col-sm-6 mb-1">
                            <select class="form-select" name="preferencia" id="preferencia_update">
                                <option>-- Preferencia --</option>
                                <option value="Alta">Alta</option>
                                <option value="Media">Media</option>
                                <option value="Baja">Baja</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-2">
                        <textarea class="form-control" name="informacion" id="informacion_update" placeholder="Informacion del cliente"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="fechaUltimaActividad">Fecha de ultima actividad<span class="text-danger"> *</span></label>
                        <input class="form-control" type="date" name="fechaUltimaActividad" id="fechaUltimaActividad_update" required />
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="notas" id="notas_update" placeholder="Notas"></textarea>
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
        var updateButtons = document.querySelectorAll('.btn-actualizar');

        // Iterar sobre cada botón de actualización
        updateButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                var userId = this.getAttribute('data-id'); // Obtener el id del usuario

                // Hacer una solicitud AJAX para obtener los datos del usuario
                fetch('Models/BLobtain.php?action=ObtainClients&id=' + userId)
                    .then(response => response.json())
                    .then(data => {
                        // Llenar los campos del formulario con los datos obtenidos
                        document.getElementById('idCliente_update').value = data.idCliente;
                        document.getElementById('foto_update').value = data.foto;
                        document.getElementById('nombreCliente_update').value = data.nombreCliente;
                        document.getElementById('apellidoPaterno_update').value = data.apellidoPaterno;
                        document.getElementById('apellidoMaterno_update').value = data.apellidoMaterno;
                        document.getElementById('fechaNacimiento_update').value = formatDate(data.fechaNacimiento);
                        document.getElementById('pais_update').value = data.pais;
                        document.getElementById('estado_update').value = data.estado;
                        document.getElementById('ciudad_update').value = data.ciudad;
                        document.getElementById('direccion_update').value = data.direccion;
                        document.getElementById('codigoPostal_update').value = data.codigoPostal;
                        document.getElementById('fechaUltimaActividad_update').value = formatDate(data.fechaUltimaActividad);
                        document.getElementById('tipoCliente_update').value = data.tipoCliente;
                        document.getElementById('preferencia_update').value = data.preferencia;
                        document.getElementById('informacion_update').value = data.informacion;
                        document.getElementById('notas_update').value = data.notas;
                    })
                    .catch(error => console.error('Error al obtener datos del usuario', error));
            });
        });

        function formatDate(dateString) {
            if (!dateString) return ''; // Manejo de casos donde la fecha es nula o indefinida

            // Convertir la fecha al formato YYYY-MM-DD si no está en ese formato
            var dateObject = new Date(dateString);
            if (isNaN(dateObject.getTime())) {
                // Si no es una fecha válida, retornar la cadena original
                return dateString;
            } else {
                // Convertir la fecha al formato YYYY-MM-DD
                var year = dateObject.getUTCFullYear();
                var month = ('0' + (dateObject.getUTCMonth() + 1)).slice(-2); // Meses son indexados desde 0, por eso se suma 1
                var day = ('0' + dateObject.getUTCDate()).slice(-2);

                return year + '-' + month + '-' + day;
            }
        }
    });
</script>

<script src="Views/Resources/assets/js/alerts.js"></script>