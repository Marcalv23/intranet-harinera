<div class="card-title text-white mt-4">
    <h3 class="mb-0">Directorio Clientes</h3>
</div>
<div id="tableExample3" data-list='{"valueNames":["nombre","pais","app","estado","direccion","telefono"],"page":10,"pagination":true}'>
    <div class="row justify-content-end g-0 mt-4">
    </div>
    <div class="tab-content">
        <div class="row justify-content g-0 mt-2">
            <div class="col-auto col-sm-5">
                <form class="mb-4">
                    <div class="input-group">
                        <input class="form-control form-control-sm shadow-none search" type="search" placeholder="Search..." aria-label="search" />
                        <div class="input-group-text bg-transparent"><span class="fa fa-search fs-10 text-600"></span></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="tab-pane fade show active" id="activos" role="tabpanel" aria-labelledby="activos-tab">
            <div class="table-responsive scrollbar">
                <table class="table table-bordered table-striped fs-10 mb-0">
                    <thead class="bg-300">
                        <tr>
                            <th class="text-900 sort" data-sort="nombre">Nombre</th>
                            <th class="text-900 sort" data-sort="pais">País</th>
                            <th class="text-900 sort" data-sort="estado">Estado</th>
                            <th class="text-900 sort" data-sort="direccion">Dirección</th>
                            <th class="text-900 sort" data-sort="telefono">Teléfono</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php
                        try {
                            $usuarios = ClientsController::getClientAll();
                            if (!empty($usuarios)) {
                                foreach ($usuarios as $usuario) {
                        ?>
                                    <tr>
                                        <td class="align-middle white-space-nowrap nombre">
                                            <a href="Cliente?idCliente=<?php echo htmlspecialchars($usuario['idCliente']); ?>">
                                                <?php echo htmlspecialchars($usuario['nombreCliente'] . ' ' . $usuario['apellidoPaterno']); ?>
                                            </a>
                                        </td>
                                        <td class="align-middle white-space-nowrap pais"><?php echo htmlspecialchars($usuario['pais']); ?></td>
                                        <td class="estado"><?php echo htmlspecialchars($usuario['estado']); ?></td>
                                        <td class="direccion"><?php echo htmlspecialchars($usuario['direccion']); ?></td>
                                        <td class="telefono"><?php echo htmlspecialchars($usuario['telefono']); ?></td>
                                    </tr>
                        <?php
                                }
                            } else {
                                echo "<tr><td colspan='5'>No se encontraron registros.</td></tr>";
                            }
                        } catch (Exception $e) {
                            // Manejo de errores: Muestra un mensaje amigable al usuario
                            echo '<tr><td colspan="5">Error al obtener Clientes: ' . $e->getMessage() . '</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <button class="btn btn-sm btn-falcon-default me-1" type="button" title="Previous" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
                <ul class="pagination mb-0"></ul>
                <button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next" data-list-pagination="next"><span class="fas fa-chevron-right"></span></button>
            </div>
        </div>
    </div>
</div>
