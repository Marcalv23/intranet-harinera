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
if (isset($_GET['action']) && $_GET['action'] === 'block' && isset($_GET['idProveedor'])) {
    $idProveedor = $_GET['idProveedor'];

    try {
        ProvidersController::blockprovider($idProveedor);
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
<div id="tableExample3" data-list='{"valueNames":["logo","prov","pa","est","ciu","sitio","fechare","fecha"],"page":10,"pagination":true}'>
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
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#bloqueados" type="button" role="tab" aria-controls="bloqueados" aria-selected="false">
                        Proveedores</button>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="Clientes">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#bloqueados" type="button" role="tab" aria-controls="bloqueados" aria-selected="false">
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
                <a href="ProveedoresBloqueados"><button class="btn btn-falcon-danger btn-sm me-2" type="button"><span class="fas fa-lock" data-fa-transform="shrink-3 down-2"></span><span class="ms-1">Bloqueados</span></button></a>
                <div data-bs-target="#exampleModal" data-bs-toggle="modal"><button class="btn btn-falcon-success btn-sm" type="button"><span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span><span class="ms-1">Agregar</span></button></div>
            </div>
        </div>
        <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="activos-tab">
            <div class="table-responsive scrollbar">
                <table class="table table-bordered table-striped fs-10 mb-0">
                    <thead class="bg-300">
                        <tr>
                            <th class="text-900 sort" data-sort="logo">Logo</th>
                            <th class="text-900 sort" data-sort="prov">Proveedor</th>
                            <th class="text-900 sort" data-sort="pa">Pais</th>
                            <th class="text-900 sort" data-sort="est">Estado</th>
                            <th class="text-900 sort" data-sort="ciu">Ciudad</th>
                            <th class="text-900 sort" data-sort="sitio">Sitio Web</th>
                            <th class="text-900 sort" data-sort="fechare">Fecha de registro</th>
                            <th class="text-900 sort" data-sort="fecha">Fecha de ultima Actividad</th>
                            <th></th>
                            <th class="text-900 sort">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php
                        try {
                            $usuarios = ProvidersController::getUsersActive();
                            if (!empty($usuarios)) {
                                foreach ($usuarios as $usuario) {
                        ?>
                                    <tr>
                                        <td class="logo"><?php echo htmlspecialchars($usuario['logo']); ?></td>
                                        <td class="prov">
                                            <a href="Contacto?idProveedor=<?php echo htmlspecialchars($usuario['idProveedor']); ?>">
                                                <?php echo htmlspecialchars($usuario['nombreEmpresa']); ?>
                                            </a>
                                        </td>
                                        <td class="pa"><?php echo htmlspecialchars($usuario['pais']); ?></td>
                                        <td class="est"><?php echo htmlspecialchars($usuario['estado']); ?></td>
                                        <td class="ciu"><?php echo htmlspecialchars($usuario['ciudad']); ?></td>
                                        <td class="sitio"><?php echo htmlspecialchars($usuario['sitioWeb']); ?></td>
                                        <td class="fechare"><?php echo htmlspecialchars($usuario['fechaRegistro']); ?></td>
                                        <td class="fecha"><?php echo htmlspecialchars($usuario['fechaUltimaActividad']); ?></td>
                                        <td><a href="#">Editar permisos</a></td>
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-info me-2 btn-actualizar" data-bs-target="#update" data-bs-toggle="modal" data-id="<?php echo htmlspecialchars($usuario['idProveedor']); ?>">
                                                    <span class="fas fa-sync-alt"></span>
                                                </a>
                                                <a class="btn btn-warning me-4" data-bs-toggle="modal" data-bs-target="#blockProvider<?php echo htmlspecialchars($usuario['idProveedor']); ?>">
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

<?php foreach ($usuarios as $usuario) : ?>
    <div class="modal fade" id="blockProvider<?php echo htmlspecialchars($usuario['idProveedor']); ?>" tabindex="-1" aria-labelledby="blockProviderLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="blockProviderLabel">Confirmar Acción</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de bloquear a <?php echo htmlspecialchars($usuario['nombreEmpresa']); ?>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="?action=block&idProveedor=<?php echo htmlspecialchars($usuario['idProveedor']); ?>">
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="row text-start justify-content-between align-items-center mb-2">
                    <div class="col-auto">
                        <h5 id="exampleModalModalLabel">Nuevo Proveedor</h5>
                    </div>
                    <button class="btn-close mb-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?php ProvidersController::postInsertProveedores() ?>
                <form action="" method="post">
                    <input value="Activo" name="estadoProveedor" type="hidden">
                    <div class="mb-3">
                        <input class="form-control" type="text" name="logo" placeholder="Logo" required />
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="nombreEmpresa" placeholder="Empresa" required />
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
                    <div class="mb-3">
                        <input class="form-control" type="text" name="direccionProveedor" placeholder="Dirección" required />
                    </div>

                    <div class="mb-3">
                        <label for="fechaRegistro">Fecha y hora de registro<span class="text-danger"> *</span></label>
                        <input class="form-control" type="datetime-local" name="fechaRegistro" value="<?php echo date('Y-m-d\TH:i'); ?>" required />
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="tipoProveedor">
                            <option>-- Tipo de proveedor --</option>
                            <option value="opcion 1">opcion 1</option>
                            <option value="opcion 2">opcion 2</option>
                            <option value="opcion 3">opcion 3</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="url" name="sitioWeb" placeholder="Sitio web" />
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="informacionProveedor" placeholder="Informacion del Proveedor"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="fechaUltimaActividad">Fecha de ultima actividad<span class="text-danger"> *</span></label>
                        <input class="form-control" type="date" name="fechaUltimaActividad" />
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="rfc" placeholder="RFC" required />
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="tipoBanco" placeholder="Tipo de Banco" required />
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="cuentaBancaria" placeholder="Cuenta Bancaria" required />
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
<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="row text-start justify-content-between align-items-center mb-2">
                    <div class="col-auto">
                        <h5 id="exampleModalModalLabel">Nuevo Proveedor</h5>
                    </div>
                    <button class="btn-close mb-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?php ProvidersController::postUpdateProveedores() ?>
                <form action="" method="post">
                    <input type="hidden" name="idProveedor" id="idProveedor_update" />
                    <div class="mb-3">
                        <input class="form-control" type="text" name="logo" id="logo_update" placeholder="Logo" required />
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="nombreEmpresa" id="nombreEmpresa_update" placeholder="Empresa" required />
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
                    <div class="mb-3">
                        <input class="form-control" type="text" name="direccionProveedor" id="direccionProveedor_update" placeholder="Dirección" required />
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="tipoProveedor" id="tipoProveedor_update">
                            <option>-- Tipo de proveedor --</option>
                            <option value="opcion 1">opcion 1</option>
                            <option value="opcion 2">opcion 2</option>
                            <option value="opcion 3">opcion 3</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="url" name="sitioWeb" id="sitioWeb_update" placeholder="Sitio web" />
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="informacionProveedor" id="informacionProveedor_update" placeholder="Informacion del Proveedor"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="fechaUltimaActividad">Fecha de ultima actividad<span class="text-danger"> *</span></label>
                        <input class="form-control" type="date" name="fechaUltimaActividad" id="fechaUltimaActividad_update" />
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="rfc" id="rfc_update" placeholder="RFC" required />
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="tipoBanco" id="tipoBanco_update" placeholder="Tipo de Banco" required />
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="cuentaBancaria" id="cuentaBancaria_update" placeholder="Cuenta Bancaria" required />
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

   
        updateButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); 

                var userId = this.getAttribute('data-id');

                // Hacer una solicitud AJAX para obtener los datos del usuario
                fetch('Models/BLobtain.php?action=ObtainProvee&id=' + userId)
                    .then(response => response.json())
                    .then(data => {
                        // Llenar los campos del formulario con los datos obtenidos
                        document.getElementById('idProveedor_update').value = data.idProveedor;
                        document.getElementById('nombreEmpresa_update').value = data.nombreEmpresa;
                        document.getElementById('direccionProveedor_update').value = data.direccionProveedor;
                        document.getElementById('pais_update').value = data.pais;
                        document.getElementById('estado_update').value = data.estado;
                        document.getElementById('ciudad_update').value = data.ciudad;
                        document.getElementById('codigoPostal_update').value = data.codigoPostal;
                        document.getElementById('informacionProveedor_update').value = data.informacionProveedor;
                        document.getElementById('fechaUltimaActividad_update').value = formatDate(data.fechaUltimaActividad);
                        document.getElementById('logo_update').value = data.logo;
                        document.getElementById('tipoProveedor_update').value = data.tipoProveedor;
                        document.getElementById('cuentaBancaria_update').value = data.cuentaBancaria;
                        document.getElementById('rfc_update').value = data.rfc;
                        document.getElementById('notas_update').value = data.notas;
                        document.getElementById('sitioWeb_update').value = data.sitioWeb;
                        document.getElementById('tipoBanco_update').value = data.tipoBanco;

                    })
                    .catch(error => console.error('Error al obtener datos del usuario', error));
            });
        });

        function formatDate(dateString) {
            if (!dateString) return ''; 
            var dateObject = new Date(dateString);
            if (isNaN(dateObject.getTime())) {
             
                return dateString;
            } else {
                var year = dateObject.getUTCFullYear();
                var month = ('0' + (dateObject.getUTCMonth() + 1)).slice(-2); 
                var day = ('0' + dateObject.getUTCDate()).slice(-2);

                return year + '-' + month + '-' + day;
            }
        }
    });
</script>
<script src="Views/Resources/assets/js/alerts.js"></script>