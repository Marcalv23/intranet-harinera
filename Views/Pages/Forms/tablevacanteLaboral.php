<head>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>
<div class="card mb-3">
<div class="row justify-content g-0">
        <div class="row justify-content-end g-0 mt-4">

        <div class="d-flex justify-content-end col-md-8 ">
            <button id="downloadCsv" class="btn btn-primary btn-sm">
                <i class="fas fa-file-csv"></i> Generar CSV
            </button>
        </div>

        <ul class="nav nav-tabs mb-1" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="solimercaservi-tab" data-section="solimercaservi" type="button" role="tab" aria-selected="true">
                    F-CMP-01
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="escolaboradores-tab" data-section="escolaboradores" type="button" role="tab" aria-selected="false">
                F-GES-04
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="esvisitantes-tab" data-section="esvisitantes" type="button" role="tab" aria-selected="false">
                F-GES-05
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="reinci-tab" data-section="reinci" type="button" role="tab" aria-selected="false">
                F-GES-08
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="postulaciones-tab" data-section="postulaciones" type="button" role="tab" aria-selected="false">
                    Postulaciones
                </button>
            </li>         
        </ul>
    </div>

    

    <div class="tab-content">
        <div id="reinci" class="tab-pane fade " role="tabpanel" aria-labelledby="reinci-tab">
            <div class="table-responsive scrollbar">
                <table id="responsesTableReinci" class="table table-bordered table-striped fs-10 mb-0">
                    <thead class="bg-300">
                        <tr>
                            <th class="text-900 sort" data-sort="id">ID</th>
                            <th class="text-900 sort" data-sort="NoEmpleado">No. Empleado</th>
                            <th class="text-900 sort" data-sort="depto">Depto</th>
                            <th class="text-900 sort" data-sort="nombre">Nombre</th>
                            <th class="text-900 sort" data-sort="apePa">Apellido Paterno</th>
                            <th class="text-900 sort" data-sort="apeMa">Apellido Materno</th>
                            <th class="text-900 sort">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Las filas se llenarán dinámicamente -->
                    </tbody>
                </table>
            </div>
        </div>

        <div id="postulaciones" class="tab-pane fade" role="tabpanel" aria-labelledby="postulaciones-tab">
            <div class="table-responsive scrollbar">
                <table id="responsesTablePostulaciones" class="table table-bordered table-striped fs-10 mb-0">
                    <thead class="bg-300">
                        <tr>
                            <th class="text-900 sort" data-sort="id">ID</th>
                            <th class="text-900 sort" data-sort="nom">Nombre(s)</th>
                            <th class="text-900 sort" data-sort="apell">Apellidos</th>
                            <th class="text-900 sort" data-sort="edad">Edad</th>
                            <th class="text-900 sort" data-sort="email">Correo</th>
                            <th class="text-900 sort" data-sort="num">Numero</th>
                            <th class="text-900 sort">Acciones</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Las filas se llenarán dinámicamente -->
                    </tbody>
                </table>
            </div>
        </div>
        <div id="escolaboradores" class="tab-pane fade" role="tabpanel" aria-labelledby="escolaboradores-tab">
            <div class="table-responsive scrollbar">
                <table id="responsesTableEscolaboradores" class="table table-bordered table-striped fs-10 mb-0">
                    <thead class="bg-300">
                        <tr>
                            <th class="text-900 sort" data-sort="id">ID</th>
                            <th class="text-900 sort" data-sort="NEmple">No. Empleado</th>
                            <th class="text-900 sort" data-sort="dep">Depto</th>
                            <th class="text-900 sort" data-sort="Nom">Nombre</th>
                            <th class="text-900 sort" data-sort="apePa">Apellido Paterno</th>
                            <th class="text-900 sort" data-sort="num">Numero</th>
                            <th class="text-900 sort">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Las filas se llenarán dinámicamente -->
                    </tbody>
                </table>
            </div>
        </div>
        
        <div id="esvisitantes" class="tab-pane fade" role="tabpanel" aria-labelledby="esvisitantes-tab">
            <div class="table-responsive scrollbar">
                <table id="responsesTableEsvisitantes" class="table table-bordered table-striped fs-10 mb-0">
                    <thead class="bg-300">
                        <tr>
                            <th class="text-900 sort" data-sort="id">ID</th>
                            <th class="text-900 sort" data-sort="NomEmpre">Nombre Empresa</th>
                            <th class="text-900 sort" data-sort="fecha">Fecha de solicitud</th>
                            <th class="text-900 sort" data-sort="Visi">Nombre Visitante</th>
                            <th class="text-900 sort" data-sort="correo">Correo</th>
                            <th class="text-900 sort" data-sort="tel">Teléfono</th>
                            <th class="text-900 sort">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Las filas se llenarán dinámicamente -->
                    </tbody>
                </table>
            </div>
        </div>
        
        <div id="solimercaservi" class="tab-pane fade show active" role="tabpanel" aria-labelledby="solimercaservi-tab">
            <div class="table-responsive scrollbar">
                <table id="responsesTableSolimercaservi" class="table table-bordered table-striped fs-10 mb-0">
                    <thead class="bg-300">
                        <tr>
                            <th class="text-900 sort" data-sort="id">ID</th>
                            <th class="text-900 sort" data-sort="Nemple">No. Empleado</th>
                            <th class="text-900 sort" data-sort="Depto">Depto</th>
                            <th class="text-900 sort" data-sort="Nom">Nombre</th>
                            <th class="text-900 sort" data-sort="apePa">Apellido Paterno</th>
                            <th class="text-900 sort" data-sort="apeMa">Apellido Materno</th>
                            <th class="text-900 sort" data-sort="email">Email</th>
                            <th class="text-900 sort">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Las filas se llenarán dinámicamente -->
                    </tbody>
                </table>
            </div>
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
</div>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script>
$(document).ready(function() {
    let currentType = 'solimercaservi'; // Tipo de datos predeterminado

    function initializeTable(tableId) {
        // Destruir cualquier instancia existente de DataTable
        if ($(`#${tableId}`).DataTable) {
            $(`#${tableId}`).DataTable().destroy();
        }

        // Inicializar DataTables
        $(`#${tableId}`).DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true
        });
    }

    $('.nav-link').on('click', function() {
        const section = $(this).data('section');
        $('.nav-link').removeClass('active');
        $(this).addClass('active');
        $('.tab-pane').removeClass('show active');
        $(`#${section}`).addClass('show active');

        currentType = section;

        // Cargar los datos de la sección activa
        loadSectionData(currentType);
    });

    async function loadSectionData(section) {
        try {
            const response = await fetch(`Views/Resources/php/get_data.php?type=${section}`);
            const data = await response.json();
            const tableBody = $(`#responsesTable${capitalize(section)} tbody`);
            const tableId = `responsesTable${capitalize(section)}`;

            tableBody.empty(); // Limpiar contenido previo

            // Determinar la URL base para la vista de detalles
            let detailsUrl;
            switch (section) {
                case 'postulaciones':
                    detailsUrl = 'detallespostu?id=';
                    break;
                case 'solimercaservi':
                    detailsUrl = 'detallesSoli?id=';
                    break;
                case 'escolaboradores':
                    detailsUrl = 'detallesesco?id=';
                    break;
                case 'esvisitantes':
                    detailsUrl = 'detallesesvisi?id=';
                    break;
                case 'reinci':
                    detailsUrl = 'detallesreinci?id=';
                    break;
                default:
                    detailsUrl = 'detallespostu?id=';
                    break;
            }

            // Insertar nuevas filas
            data.forEach(row => {
                let rowHtml = '<tr>';
                for (let key in row) {
                    rowHtml += `<td>${row[key]}</td>`;
                }
                rowHtml += `<td><a href="${detailsUrl}${row.id}" class="btn btn-secondary">Ver detalles</a></td>`;
                rowHtml += '</tr>';
                tableBody.append(rowHtml);
            });

            // Inicializar DataTables para la nueva tabla cargada
            initializeTable(tableId);

        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }

    // Función para capitalizar la primera letra de una cadena
    function capitalize(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    // Evento para manejar la descarga del CSV
    $('#downloadCsv').on('click', function() {
        // Redireccionar a la URL del script PHP para generar el CSV
        window.location.href = `Views/Pages/Forms/sections/export_csv.php?type=${currentType}`;
    });

    // Inicializar la primera pestaña
    loadSectionData('solimercaservi');
});
</script>