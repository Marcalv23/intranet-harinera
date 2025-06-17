<?php
// Obtener el idCliente de la URL
$idCliente = isset($_GET['idCliente']) ? $_GET['idCliente'] : '';

// Variable para mensaje de error
$mensaje = '';

if ($idCliente) {
    // Instanciar el controlador ClienteController
    $controller = new ClientsController();

    // Obtener la información del cliente por idCliente
    $cliente = $controller->getClientbyId($idCliente);

    // Verificar si hay resultados
    if (!$cliente) {
        // Mensaje de alerta si no hay contactos
        $mensaje = '<div class="alert alert-danger" role="alert">
                      <h4 class="alert-heading fw-semi-bold">Cliente sin contactos</h4>
                      <p>El cliente no tiene contactos registrados.</p>
                      <hr />
                      <p class="mb-0">Aún no se han registrado contactos para este cliente.</p>
                    </div>';
    }
} else {
    // Redirigir o manejar el error si no se proporciona idCliente
    // Ejemplo: header('Location: error.php');
    // exit();
}
?>

<div class="card-title text-white mt-4">
    <h3 class="mb-0">Información Clientes</h3>
</div>
<div id="tableExample3" data-list='{"valueNames":["nombre","app","email","tel","tipoContacto","semana","finsemana"],"page":10,"pagination":true}'>
    <div class="tab-content mt-4">
        <div class="row justify-content-start g-0 mt-2">
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
        <div class="table-responsive scrollbar">
            <?php if ($mensaje) : ?>
                <?php echo $mensaje; ?>
            <?php else : ?>
                <table class="table table-bordered table-striped fs-10 mb-0">
                    <thead class="bg-300">
                        <tr>
                            <th class="text-900 sort" data-sort="nombre">Nombre</th>
                            <th class="text-900 sort" data-sort="email">Email</th>
                            <th class="text-900 sort" data-sort="tel">Teléfono</th>
                            <th class="text-900 sort" data-sort="tipoContacto">Tipo de Contacto</th>
                            <th class="text-900 sort" data-sort="semana">HS ATT Semana</th>
                            <th class="text-900 sort" data-sort="finsemana">HS ATT Finsemana</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php foreach ($cliente as $row) : ?>
                            <tr>
                                <td class="align-middle white-space-nowrap nombre">
                                    <?php echo htmlspecialchars($row['nombre'] . ' ' . $row['apellidoPaterno']); ?>
                                </td>
                                <td class="align-middle white-space-nowrap email"><?php echo htmlspecialchars($row['email']); ?></td>
                                <td class="tel"><?php echo htmlspecialchars($row['telefono']); ?></td>
                                <td class="tipoContacto"><?php echo htmlspecialchars($row['tipoContacto']); ?></td>
                                <td class="semana"><?php echo htmlspecialchars($row['horaAtencionSemana']); ?></td>
                                <td class="finsemana"><?php echo htmlspecialchars($row['horaAtencionFinseman']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
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
