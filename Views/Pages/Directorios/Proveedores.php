<div class="card-title text-white mt-4">
    <h3 class="mb-0">Directorio de Proveedores</h3>
</div>
<div id="tableExample3" data-list='{"valueNames":["logo","nombre","direccion","sitweb","rfc","email","tel"],"page":10,"pagination":true}'>
    <div class="row justify-content-end g-0 mt-4">
    </div>
    <div class="tab-content">
        <div class="row justify-content g-0 mt-2">
            <div class="col-auto col-sm-5">
                <form class="mb-4">
                    <div class="input-group">
                        <input class="form-control form-control-sm shadow-none search" type="search" placeholder="Buscar..." aria-label="search" />
                        <div class="input-group-text bg-transparent">
                            <span class="fa fa-search fs-10 text-600"></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="tab-pane fade show active" id="activos" role="tabpanel" aria-labelledby="activos-tab">
            <div class="table-responsive scrollbar">
                <table class="table table-bordered table-striped fs-10 mb-0">
                    <thead class="bg-300">
                        <tr>
                            <th class="text-900 sort">Logo</th>
                            <th class="text-900 sort" data-sort="nombre">Nombre</th>
                            <th class="text-900 sort" data-sort="direccion">Dirección</th>
                            <th class="text-900 sort" data-sort="sitweb">Sitio web</th>
                            <th class="text-900 sort" data-sort="rfc">RFC</th>
                            <th class="text-900 sort" data-sort="tel">Teléfono</th>
                            <th class="text-900 sort" data-sort="email">Email</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php
                        try {
                            $proveedores = ProvidersController::getProvidersAll();
                            if (!empty($proveedores)) {
                                foreach ($proveedores as $proveedor) {
                        ?>
                                    <tr>
                                        <td class="align-middle logo">
                                            <?php echo htmlspecialchars($proveedor['logo']); ?>
                                        </td>
                                        <td class="align-middle nombre">
                                            <a href="Contacto?idProveedor=<?php echo htmlspecialchars($proveedor['idProveedor']); ?>">
                                                <?php echo htmlspecialchars($proveedor['nombreEmpresa']); ?>
                                            </a>
                                        </td>
                                        <td class="direccion">
                                            <?php echo htmlspecialchars($proveedor['direccionProveedor']); ?>
                                        </td>
                                        <td class="sitweb">
                                            <?php echo htmlspecialchars($proveedor['sitioWeb']); ?>
                                        </td>
                                        <td class="rfc">
                                            <?php echo htmlspecialchars($proveedor['rfc']); ?>
                                        </td>
                                        <td class="tel">
                                            <?php echo htmlspecialchars($proveedor['telefono']); ?>
                                        </td>
                                        <td class="email">
                                            <?php echo htmlspecialchars($proveedor['email']); ?>
                                        </td>
                                    </tr>
                        <?php
                                }
                            } else {
                                echo "<tr><td colspan='7'>No se encontraron registros.</td></tr>";
                            }
                        } catch (Exception $e) {
                            // Manejo de errores: Muestra un mensaje amigable al usuario
                            echo '<tr><td colspan="7">Error al obtener proveedores: ' . $e->getMessage() . '</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <button class="btn btn-sm btn-falcon-default me-1" type="button" title="Previous" data-list-pagination="prev">
                    <span class="fas fa-chevron-left"></span>
                </button>
                <ul class="pagination mb-0"></ul>
                <button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next" data-list-pagination="next">
                    <span class="fas fa-chevron-right"></span>
                </button>
            </div>
        </div>
    </div>
</div>
