<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$user_role = isset($_SESSION['user_rol']) ? $_SESSION['user_rol'] : 'Usuario'; // Valor por defecto 'Usuario'
?>

<div class="card mb-3">
<head>
<link rel="stylesheet" href="Views/Resources/css/catalogo_de_colaboradores.css"> 
<link rel="stylesheet" href="Views/Resources/vendors/dropzone/dropzone.css"> 

<style>
        .custom-color {
            color: #2c7be5; /* Cambia a tu color preferido, aquí es un tono naranja */
        }
    </style>
</head>

    <div class="card-header z-1 col-md-8 mx-auto">
        <header class="">
            <h1 class="custom-color">F-GES-05 Entrada/salida de equipo de computo (visitantes) REV. 01</h1>
            <h5 class="text-600">Formato de captura para el control de Entrada y Salida de equipo de cómputo y/o electrónicos, para visitantes</h5>
        </header>
    </div>

    <div class="card-body col-md-8 mx-auto">
        <form id="form2" onsubmit="event.preventDefault(); showPreview();">
            <!-- Step 1 -->
            <div class="form-step form-step-active">
                <div class="col-md-8 mx-auto">
                    <label for="fecha_de_solicitud">Fecha de solicitud<span class="text-danger"> *</span></label>
                    <input class="form-control datetimepicker form-control form-control-sm" type="text" id="fecha_de_solicitud" name="fecha_de_solicitud" readonly>
                    <p class="fs-10 mb-0">Fecha y hora en la que se realiza la solicitud</p>
                </div>
                <br>
                <div class="col-md-8 mx-auto">
                    <label for="nombre_empresa">Nombre de la empresa<span class="text-danger"> *</span></label>
                    <input data-name="Nombre de la empresa"type="text" class="form-control form-control-sm" id="nombre_empresa" placeholder="" required>
                    <p class="fs-10 mb-0">Nombre de la empresa a la que representa</p>
                </div>
                <br>
                <div class="col-md-8 mx-auto">
                    <label for="nombre_visitante">Nombre de visitante<span class="text-danger"> *</span></label>
                    <input data-name="Nombre de visitante" type="text" class="form-control form-control-sm" id="nombre_visitante" placeholder="" required>
                    <p class="fs-10 mb-0">Nombre completo del visitante, incluye apellidos</p>
                </div>
                <br>
                <div class="col-md-8 mx-auto">
                    <label for="correo">Correo electrónico<span class="text-danger"> *</span></label>
                    <input data-name="Correo electrónico" type="email" class="form-control form-control-sm" id="correo" placeholder="" required>
                    <p class="fs-10 mb-0">Correo electrónico de contacto del visitante</p>
                </div>
                <br>
                <div class="col-md-8 mx-auto">
                    <label for="telefono">Número de teléfono<span class="text-danger"> *</span></label>
                    <input data-name="Número de teléfono" type="tel" class="form-control form-control-sm" id="telefono" placeholder="(000) 000-0000" required>
                    <p class="fs-10 mb-0">Número de teléfono de contacto del visitante</p>
                </div>
                <br>
                <div class="col-md-8 mx-auto">
                <button type="button" class="btn btn-primary" onclick="nextStep()">Siguiente</button>
                <?php if ($user_role == 'administrador'): ?>
                    <button type="button" class="btn btn-secondary" data-form-name="ESVisitantes" data-toggle="modal" data-target="#exampleModal">
                        Añadir más correos
                    </button>
                <?php endif; ?>

            </div>
                
            </div>

            <!-- Step 2 -->
            <div class="form-step ">
                <div class="col-md-8 mx-auto">
                    <label for="folio">Folio<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control form-control-sm" id="folio" placeholder="Folio" required readonly>
                    <p class="fs-10 mb-0">Número de folio</p>
                </div>
                <br>
                <div class="col-md-8 mx-auto">
                    <label for="prioridad">Propiedad del equipo<span class="text-danger"> *</span></label>
                    <select data-name="Propiedad del equipo" class="form-select form-select-sm" id="prioridad" required>
                        <option>-- Seleccione --</option>
                        <option>Harinera de Oriente</option>
                        <option>Uso personal</option>
                    </select>
                    <p class="fs-10 mb-0">Seleccione quién es el propietario del equipo</p>
                </div>
                <br>
                <div class="col-md-8 mx-auto">
                    <label for="entrada_o_salida">¿Entrada o salida?<span class="text-danger"> *</span></label>
                    <select data-name="¿Entrada o salida?" class="form-select form-select-sm" id="entrada_o_salida" required>
                        <option>-- Seleccione --</option>
                        <option>Entrada</option>
                        <option>Salida</option>
                    </select>
                    <p class="fs-10 mb-0">Seleccione una opción</p>
                </div>
                <br>
                <div class="col-md-8 mx-auto">
                    <label for="fecha_devolucion">Fecha de devolucion<span class="text-danger"> *</span></label>
                    <input data-name="Fecha de devolucion" class="form-control datetimepicker form-control form-control-sm" id="fecha_devolucion" name="fecha_devolucion" type="text" placeholder="dd/mm/yy" data-options='{"disableMobile":true}' type="date">
                    <p class="fs-10 mb-0">Introduzca la fecha de devolución</p>
                </div>
                <br>
                <div class="col-md-8 mx-auto">
                    <label for="fines_utilizacion">Motivo<span class="text-danger"> *</span></label>
                    <textarea data-name="Motivo" class="form-control" rows="6" cols="50" id="fines_utilizacion" placeholder="" style="resize: none;"></textarea>
                    <p class="fs-10 mb-0">Escriba brevemente el motivo de la entrada o salida del equipo</p>
                </div>
                <br>
                <div class="col-md-8 mx-auto">
                    <div class="table-responsive scrollbar mb-3">
                        <label for="caracteristicas">Características<span class="text-danger"> *</span></label>
                        <table class="table table-striped overflow-hidden" id="dynamicTable">
                            <thead>
                                <tr>
                                    <th>Tipo de equipo</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Número de serie</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="row_1">
                                    <td>
                                        <select name="tipo_equipo[]" class="form-select form-select-sm">
                                            <option>-- Seleccione --</option>
                                            <option value="Laptop">Laptop</option>
                                            <option value="PC de escritorio">PC de escritorio</option>
                                            <option value="Tableta">Tableta</option>
                                            <option value="Monitor/Pantalla/Proyector">Monitor/Pantalla/Proyector</option>
                                            <option value="Equipos de impresión y multifuncionales">Equipos de impresión y multifuncionales</option>
                                            <option value="Hardware (teclado/mouse/videocámaras/adaptadores)">Hardware (teclado/mouse/videocámaras/adaptadores)</option>
                                            <option value="Otro">Otro</option>
                                        </select>
                                    </td>
                                    <td><input class="form-control form-control-sm" type="text" name="marca[]"></td>
                                    <td><input class="form-control form-control-sm" type="text" name="modelo[]"></td>
                                    <td><input class="form-control form-control-sm" type="text" name="numero_serie[]"></td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        
                                        <label>¿Este equipo pertenece a HO?<span class="text-danger"> *</span></label>
                                        <div id="radio_group_1">
                                            <input type="radio" class="form-check-input me-2" name="pertenece_a_ho_0" value="si" required>Si
                                            <input type="radio" class="form-check-input me-2" name="pertenece_a_ho_0" value="no" required>No
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-falcon-default btn-sm me-1 mb-1" onclick="addRow()">Agregar Fila</button>
                    </div>
                </div>
                <br>
                <div class="col-md-8 mx-auto">
                    <label for="evidencia">Evidencia<span class="text-danger"> *</span></label>
                    <form class="dropzone dropzone-multiple p-0" id="my-awesome-dropzone" data-dropzone=" action="#!">
                        <div id="my-dropzone" class="dropzone">
                            <div class="dz-message">
                                <img src="Views/Resources/assets/img/icons/cloud-upload.svg" width="25"  alt=""> <!-- Ícono local -->
                                <p>Arrastre y suelte archivos aquí.</p>
                            </div>
                        </div>
                    </form>
                    <p class="fs-10 mb-0">Cargue aquí las fotografías que sirven como evidencia. Máximo 5 fotografías. Formatos disponibles: jpg, jpeg, png. Límite máximo de 5MB por archivo</p>
                </div>
                <br>
                <div class="col-md-8 mx-auto">
                <button type="button" class="btn btn-primary" onclick="prevStep()">Anterior</button>
                <button type="button" class="btn btn-primary" onclick="nextStep()">Siguiente</button>
                </div>
                
            </div>

            <!-- Step 3 -->
            <div class="form-step col-md-8 mx-auto">
                <div class="mb-3">
                    <label for="nombre_responsable">Nombre de responsable<span class="text-danger"> *</span></label>
                    <input data-name="Nombre de responsable" type="text" class="form-control" id="nombre_responsable" placeholder="Nombre de responsable" required>
                    <p class="fs-10 mb-0">Nombre de la persona que hace la solicitud</p>
                </div>
                <br>
                <div class="mb-3">
                    <label for="firma_de_responsable">Firma de responsable<span class="text-danger"> *</span></label>
                    <textarea id="firma_de_responsable" class="form-control" rows="5" placeholder="" readonly></textarea>
                    <p class="fs-10 mb-0">Firma de la persona que hace la solicitud</p>
                </div>
                <br>
                <div class="mb-3">
                        <label for="aceptacionRes">Aceptación de responsabilidad<span class="text-danger"> *</span></label>
                        <div class="d-flex">
                            <input data-name="Aceptación de responsabilidad" type="checkbox" class="form-check-input me-2" id="aceptacionRes" required>
                            <p class="fs-10 mb-0" id="avisoText">
                            Al firmar esta solicitud, me comprometo a asumir la responsabilidad del cuidado y uso 
                            de los equipos, siguiendo las políticas y procedimientos establecidos por la empresa.
                            </p>
                        </div>
                </div>
                <br>
                <div class="mb-3">
                    <label for="nombre_aut_ho">Nombre de quien autoriza en HO <span class="text-danger"> *</span></label>
                    <input data-name="Nombre de quien autoriza en HO" type="text" class="form-control" id="nombre_aut_ho" placeholder="Nombre de quien autoriza en HO" required>
                    <p class="fs-10 mb-0">Nombre de la persona que autoriza esta solicitud</p>
                </div>
                <br>
                <div class="mb-3">
                    <label for="correo_aut_ho">Correo electrónico de quien autoriza en HO <span class="text-danger"> *</span></label>
                    <input data-name="Correo electrónico de quien autoriza en HO" type="email" class="form-control" id="correo_aut_ho" placeholder="Correo electrónico de quien autoriza en HO" required>
                    <p class="fs-10 mb-0">Correo electrónico de la persona que autoriza esta solicitud</p>
                </div>
                <br>
                <div class="mb-3">
                    <label for="firma_aut_ho">Firma de quien autoriza en HO<span class="text-danger"> *</span></label>
                    <textarea id="firma_aut_ho" class="form-control" rows="5" placeholder="" readonly></textarea>
                    <p class="fs-10 mb-0">Firma de la persona que autoriza esta solicitud</p>
                </div>
                <br>
                <button type="button" class="btn btn-primary" onclick="prevStep()">Anterior</button>
                <button type="button" class="btn btn-primary" onclick="validateAndShowPreview()">Verificar respuestas</button>
            </div>
        </form>

            <div class="table-responsive scrollbar" id="previewSection" style="display: none;">
                <h5 class="text-600">Vista previa de respuestas</h5>
                <br>
                <table class="table table-bordered overflow-hidden">
                    <colgroup>
                        <col class="bg-primary-subtle" />
                        <col />
                        <col />
                    </colgroup>
                    <thead>
                        <tr class="btn-reveal-trigger">
                            <th scope="col">Campo</th>
                            <th scope="col">Respuesta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong class="text-primary">Fecha de solicitud:</strong></td>
                            <td><span id="preview_fecha_de_solicitud" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Nombre de la empresa:</strong></td>
                            <td><span id="preview_nombre_empresa" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Nombre de visitante:</strong></td>
                            <td><span id="preview_nombre_visitante" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Correo electrónico:</strong></td>
                            <td><span id="preview_correo" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Número de teléfono:</strong></td>
                            <td><span id="preview_telefono" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Folio:</strong></td>
                            <td><span id="preview_folio" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Propiedad del equipo:</strong></td>
                            <td><span id="preview_prioridad" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">¿Entrada o salida?</strong></td>
                            <td><span id="preview_entrada_o_salida" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Fecha de devolución:</strong></td>
                            <td><span id="preview_fecha_devolucion" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Motivo:</strong></td>
                            <td><span id="preview_fines_utilizacion" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Características:</strong></td>
                            <td >
                                <div class="table-responsive scrollbar">
                                    <table class="table table-bordered overflow-hidden" id="preview_dynamicTable">
                                        <colgroup>
                                            <col />
                                            <col />
                                            <col />
                                            <col />
                                            <col />
                                        </colgroup>
                                        <thead>
                                            <tr class="btn-reveal-trigger">
                                                <th scope="col">Tipo de equipo</th>
                                                <th scope="col">Marca</th>
                                                <th scope="col">Modelo</th>
                                                <th scope="col">Número de serie</th>
                                                <th scope="col">¿Este equipo pertenece a HO?</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Evidencia:</strong></td>
                            <td id="preview_evidencia_container"></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Nombre de responsable:</strong></td>
                            <td><span id="preview_nombre_responsable" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Firma de responsable:</strong></td>
                            <td><span id="preview_firma_de_responsable" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Nombre de quien autoriza en HO:</strong></td>
                            <td><span id="preview_nombre_aut_ho" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Correo electrónico de quien autoriza en HO:</strong></td>
                            <td><span id="preview_correo_aut_ho" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Firma de quien autoriza en HO:</strong></td>
                            <td><span id="preview_firma_aut_ho" class="text-muted"></span></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <button type="button" class="btn btn-secondary" onclick="hidePreview()">Editar respuestas</button>
                <button id="sendEmail" type="button" class="btn btn-success" onclick="submitForm()">Enviar formulario</button>
            </div>
        
            <!-- Campo oculto para almacenar el nombre del formulario -->
            <input type="hidden" id="formName" name="formName">

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="emailsModalLabel">Agregar Correos Adicionales</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="extraEmailsForm" data-form-name="ESVisitantes" onsubmit="saveEmails(event)">
                                <div id="emailsContainer">
                                    <!-- Los campos de correo se agregarán aquí -->
                                </div>
                                <button data-form-name="ESColaboradores" type="button" class="btn btn-secondary" onclick="addEmailField()">Agregar otro correo</button>
                                <button data-form-name="ESColaboradores" type="submit" class="btn btn-primary">Guardar correos</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
        
</div>

    <!-- JavaScript Files -->
    <script defer src="Views/Resources/js/entrada_salida_de_equipo_visitantes.js"></script>
    <script src="Views/Resources/vendors/dropzone/dropzone-min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


    <script> 
        function validateForm() {
            var isValid = true;
            var errorMessages = [];
            var fields = [
                'nombre_empresa',
                'nombre_visitante',
                'correo',
                'telefono',
                'prioridad',
                'entrada_o_salida',
                'fecha_devolucion',
                'fines_utilizacion',
                'nombre_responsable',
                'nombre_aut_ho',
                'correo_aut_ho',
                'aceptacionRes'

            ];

            fields.forEach(function(field) {
        var element = document.getElementById(field);
        if (!element) {
            isValid = false;
            errorMessages.push('El campo con ID "' + field + '" no se encuentra en el formulario.');
        } else {
            var fieldName = element.dataset.name || element.placeholder;

            if (element.type === 'checkbox') {
                // Verificar si el checkbox está marcado
                if (!element.checked) {
                    isValid = false;
                    errorMessages.push('Por favor, marque ' + fieldName + '.');
                }
            } else if (element.tagName.toLowerCase() === 'select') {
                // Verificar si el valor seleccionado es el marcador de posición
                if (element.value === '-- Seleccione --' || element.value === '') {
                    isValid = false;
                    errorMessages.push('Por favor, selecciona una opción en ' + fieldName + '.');
                }
            } else {
                // Verificar si el valor está vacío
                if (!element.value.trim()) {
                    isValid = false;
                    errorMessages.push('Por favor, llene el campo ' + fieldName + '.');
                }
            }
        }
    });

    if (!isValid) {
        alert(errorMessages.join('\n'));
    }

    return isValid;
}
        
    </script>

    <br>
    <br>