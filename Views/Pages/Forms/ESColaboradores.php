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
<link href="Views/Resources/vendors/dropzone/dropzone.css" rel="stylesheet" /> 

<style>
        .custom-color {
            color: #FF5733; /* Cambia a tu color preferido, aquí es un tono naranja */
        }
    </style>
</head>

    <div class="card-header z-1 col-md-8 mx-auto">
        <header class="">
            <h1 class="text-primary custom-color">F-GES-04 Entrada/salida de equipo de cómputo (colaboradores) REV. 01</h1>
            <h5 class="text-600">Formato de captura para el control de Entrada y Salida de equipo de cómputo y/o electrónicos, para colaboradores</h5>
        </header>
    </div>

<div class="card-body col-md-8 mx-auto">

        <form id="form2" onsubmit="event.preventDefault(); showPreview();">
            <!-- Step 1 -->
            <div class="form-step form-step-active col-md-8 mx-auto">
                <div class="form-group">
                    <label for="N_colaborador">N de colaborador<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" id="N_colaborador" name="N_colaborador" placeholder="N de colaborador" value="<?php echo isset($_SESSION['N_colaborador']) ? $_SESSION['N_colaborador'] : ''; ?>" required readonly>
                </div>
                <br>
                <div class="form-group">
                    <label for="departamento">Departamento<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" id="departamento" name="departamento" placeholder="Departamento" value="<?php echo isset($_SESSION['departamento']) ? $_SESSION['departamento'] : ''; ?>" required readonly>
                </div>
                <br>
                <div class="form-group">
                    <label for="N_empleado">Nombre de colaborador<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" id="N_empleado" name="N_empleado" placeholder="Nombre de colaborador" value="<?php echo isset($_SESSION['nombre']) ? $_SESSION['nombre'] : ''; ?>" required readonly>
                </div>
                <br>
                <div class="form-group">
                    <label for="Ape_paterno">Apellido paterno<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" id="Ape_paterno" name="Ape_paterno" placeholder="Apellido paterno" value="<?php echo isset($_SESSION['Ape_paterno']) ? $_SESSION['Ape_paterno'] : ''; ?>" required readonly>
                </div>
                <br>
                <div class="form-group">
                    <label for="Ape_materno">Apellido materno<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" id="Ape_materno" name="Ape_materno" placeholder="Apellido materno" value="<?php echo isset($_SESSION['Ape_materno']) ? $_SESSION['Ape_materno'] : ''; ?>" required readonly>
                </div>
                <br>
                <div class="form-group">
                    <label for="correo">Correo electrónico<span class="text-danger"> *</span></label>
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo electrónico" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" required readonly>
                </div>
                <br>
                <div class="form-group">
                    <label for="telefono">Número de teléfono<span class="text-danger"> *</span></label>
                    <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Número de teléfono" value="<?php echo isset($_SESSION['telefono']) ? $_SESSION['telefono'] : ''; ?>" required readonly>
                </div>
                <br>
                <button type="button" class="btn btn-primary" onclick="nextStep()">Siguiente</button>
                <?php if ($user_role == 'administrador'): ?>
                    <button type="button" class="btn btn-secondary" data-form-name="ESColaboradores" data-toggle="modal" data-target="#exampleModal">
                        Añadir más correos
                    </button>
                <?php endif; ?>
            </div>

            <!-- Step 2 -->
            <div class="form-step col-md-8 mx-auto">
                <div class="form-group">
                    <label for="folio">Folio<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" id="folio" placeholder="Folio" required readonly>
                    <p class="fs-10 mb-0">Número de folio</p>
                </div>
                <br>
                <div class="form-group">
                    <label for="folio">Fecha de solicitud<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" id="fecha_solicitud" placeholder="Folio" required readonly>
                    <p class="fs-10 mb-0">Fecha y hora en la que se realiza la solicitud</p>
                </div>
                <br>
                <div class="form-group">
                    <label for="prioridad">Propietario del equipo<span class="text-danger"> *</span></label>
                    <select data-name="Propietario del equipo" class="form-select" id="prioridad" required>
                        <option>-- Seleccione --</option>
                        <option>Harinera de Oriente</option>
                        <option>Uso personal</option>
                    </select>
                    <p class="fs-10 mb-0">Seleccione quién es el propietario del equipo</p>
                </div>
                <br>
                <div class="form-group">
                    <label for="entrada_o_salida">¿Entrada o salida?<span class="text-danger"> *</span></label>
                    <select data-name="¿Entrada o salida?" class="form-select" id="entrada_o_salida" required>
                        <option>-- Seleccione --</option>
                        <option>Entrada</option>
                        <option>Salida</option>
                    </select>
                    <p class="fs-10 mb-0">Seleccione una opción</p>
                </div>
                <br>
                <div class="form-group">
                    <label for="fecha_devolucion">Fecha de devolucion<span class="text-danger"> *</span></label>
                    <input data-name="Fecha de devolucion" class="form-control datetimepicker" type="date" id="fecha_devolucion" name="fecha_devolucion" type="text" placeholder="dd/mm/yy" data-options='{"disableMobile":true}' />
                    <p class="fs-10 mb-0">Introduzca la fecha de devolución</p>
                </div>
                <br>
                <div class="mb-3">
                    <label for="fines_utilizacion">Motivo<span class="text-danger"> *</span></label>
                    <textarea data-name="Motivo" class="form-control" rows="6" cols="50" id="fines_utilizacion" placeholder="" style="resize: none;"></textarea>
                    <p class="fs-10 mb-0">Escriba brevemente el motivo de la entrada o salida del equipo</p>
                </div>
                <br>
                <div class="mb-3">
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
                                <tr>
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
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-falcon-default btn-sm me-1 mb-1" onclick="addRow()">Agregar Fila</button>
                    </div>
                </div>
                <br>
                <div class="mb-3">
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
                <button type="button" class="btn btn-primary" onclick="prevStep()">Anterior</button>
                <button type="button" class="btn btn-primary" onclick="nextStep()">Siguiente</button>
            </div>
            <!-- Step 3 -->
            <div id="form-step-4" class="form-step col-md-8 mx-auto">
                <div class="form-group">
                    <label for="nombre_colab">Nombre del colaborador<span class="text-danger"> *</span></label>
                    <input data-name="Nombre del colaborador" type="text" class="form-control" id="nombre_colab" placeholder="" required>
                    <p class="fs-10 mb-0">Nombre del colaborador que hace la solicitud</p>
                </div>
                <br>
                <div class="form-group">
                    <label for="firma_de_responsable">Firma de responsable<span class="text-danger"> *</span></label>
                    <textarea id="firma_de_responsable" class="form-control" rows="5" placeholder="" readonly></textarea>
                    <p class="fs-10 mb-0">Firma del colaborador que hace la solicitud</p>
                </div>
                <br>
                <div class="mb-3">
                        <label for="aceptacionRes">Aceptación de responsabilidad<span class="text-danger"> *</span></label>
                        <div class="d-flex">
                            <input type="checkbox" class="form-check-input me-2" id="aceptacionRes" required>
                            <p class="fs-10 mb-0" id="avisoText">
                            Me comprometo a asumir la responsabilidad del cuidado y uso, siguiendo las políticas y procedimientos establecidos por la empresa.
                            </p>
                        </div>
                    </div>
                <br>
                <div class="form-group">
                    <label for="nombre_aut_ho">Nombre de quien autoriza<span class="text-danger"> *</span></label>
                    <input data-name="Nombre de quien autoriza" type="text" class="form-control" id="nombre_aut_ho" placeholder="Nombre de quien autoriza en HO" required>
                    <p class="fs-10 mb-0">Nombre de la persona que autoriza esta solicitud</p>
                </div>
                <br>
                <div class="form-group">
                    <label for="correo_aut_ho">Correo electrónico de quien autoriza<span class="text-danger"> *</span></label>
                    <input data-name="Correo electrónico de quien autoriza" type="email" class="form-control" id="correo_aut_ho" placeholder="Correo electrónico de quien autoriza en HO" required>
                    <p class="fs-10 mb-0">Correo electrónico de la persona que autoriza esta solicitud</p>
                </div>
                <br>
                <div class="form-group">
                    <label for="firma_aut_ho">Firma de quien autoriza<span class="text-danger"> *</span></label>
                    <textarea id="firma_aut_ho" class="form-control" rows="5" placeholder="" readonly></textarea>
                    <p class="fs-10 mb-0">Firma de la persona que autoriza esta solicitud</p>
                </div>
                <br>
                <button type="button" class="btn btn-primary" onclick="prevStep()">Anterior</button>
                <button id="previewButton" type="button" class="btn btn-primary" onclick="validateAndShowPreview()">Verificar respuestas</button>
            </div>
            </form>

            <div class="table-responsive scrollbar" id="preview" style="display: none;">
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
                            <td><strong class="text-primary">N de colaborador:</strong></td>
                            <td><span id="preview_N_colaborador" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Departamento:</strong></td>
                            <td><span id="preview_departamento" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Nombre de colaborador:</strong></td>
                            <td><span id="preview_N_empleado"" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Apellido paterno:</strong></td>
                            <td><span id="preview_Ape_paterno"" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Apellido materno:</strong></td>
                            <td><span id="preview_Ape_materno"" class="text-muted"></span></td>
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
                            <td><strong class="text-primary">Fecha de solicitud:</strong></td>
                            <td><span id="preview_fecha_solicitud" class="text-muted"></span></td>
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
                            <td>
                                <div class="table-responsive scrollbar">
                                    <table class="table table-bordered overflow-hidden" id="preview_caracteristicas">
                                        <colgroup>
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
                            <td><strong class="text-primary">Nombre del colaborador:</strong></td>
                            <td><span id="preview_nombre_colab" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Firma de responsable:</strong></td>
                            <td><span id="preview_firma_de_responsable" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Aceptación de responsabilidad:</strong></td>
                            <td><span id="preview_aceptacion_de_responsabilidad" class="text-muted"></span></td>
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
                <button id="sendEmail"  type="button" class="btn btn-success" onclick="submitForm()">Enviar formulario</button>
            </div>       
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
                        <form id="extraEmailsForm" data-form-name="ESColaboradores" onsubmit="saveEmails(event)">
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

<!-- JavaScript Files -->
<script defer src="Views/Resources/js/entrada_salida_de_equipo_colaboradores.js"></script>
<script src="Views/Resources/vendors/dropzone/dropzone-min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


<script> 
        function validateForm() {
            var isValid = true;
            var errorMessages = [];
            var fields = [
                'prioridad',
                'entrada_o_salida',
                'fecha_devolucion',
                'fines_utilizacion',
                'nombre_colab',
                'nombre_aut_ho',
                'correo_aut_ho'
            ];

            fields.forEach(function(field) {
                var element = document.getElementById(field);
                if (!element) {
                    isValid = false;
                    errorMessages.push('El campo con ID "' + field + '" no se encuentra en el formulario.');
                } else {
                    var fieldName = element.dataset.name || element.placeholder;

                    if (element.tagName.toLowerCase() === 'select') {
                        // Check if the selected value is the placeholder
                        if (element.value === '-- Seleccione --') {
                            isValid = false;
                            errorMessages.push('Por favor, selecciona una opción en ' + fieldName + '.');
                        }
                    } else {
                        // Check for empty value
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