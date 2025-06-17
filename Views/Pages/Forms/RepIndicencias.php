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
<!-- Contenido principal -->

<style>
        .custom-color {
            color: #2c7be5; /* Cambia a tu color preferido, aquí es un tono naranja */
        }
    </style>
</head>

        <div>
            <header class="card-header z-1 col-md-8 mx-auto">
                <h1 class="custom-color">F-GES-08 Reporte de incidencias informáticas</h1>
                <h5 class="text-600">Formulario para el reporte de incidencias</h5>
            </header>
        </div>
<div class="card-body col-md-8 mx-auto">


<form id="form2" onsubmit="event.preventDefault(); showPreview();">
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
            <button type="button" class="btn btn-secondary" data-form-name="repIncidencias" data-toggle="modal" data-target="#exampleModal">
                Añadir más correos
            </button>
        <?php endif; ?>
    
    </div>

        <!-- Step 2 -->
        <div class="form-step col-md-8 mx-auto">
                <div class="form-group">
                    <label for="Folio">Folio<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" id="folio" name="folio" readonly required>
                </div>
                <br>  
            <div class="form-group">
                <label for="fecha_reporte">Fecha de reporte<span class="text-danger"> *</label>
                <input class="form-control datetimepicker" type="text" id="fecha_reporte" name="fecha_reporte" readonly>
                <p class="fs-10 mb-0">Fecha y hora en la que se reporta la incidencia</p>
            </div>
            <br>  
            <div class="form-group">
                <label for="tipo_inc">¿Qué tipo de incidencia reporta?<span class="text-danger"> *</span></label>
                <select data-name="Tipo de incidente" class="form-select" id="tipo_inc" name="tipo_inc" required>
                    <option >-- Seleccione --</option>
                    <option>Hardware (pantalla, impresora, disco duro ...)</option>
                    <option>Internet</option>
                    <option>Software (antivirus, office, correo electrónico ...)</option>
                    <p class="fs-10 mb-0">Seleccione el tipo de incidencia qué reporta</p>
                </select>
            </div>
            <br>  
            <div class="form-group">
                <label for="gestiona">¿En qué departamento o área de la organización se tiene esta incidencia?<span class="text-danger"> *</label>
                <input data-name="Departamento reportado" type="text" class="form-control" id="dep_rep" name="dep_rep" placeholder="" required>
                <p class="fs-10 mb-0">Indique el lugar en donde está ocurriendo la incidencia</p>
            </div>
            <br>  
            <div class="form-group">
                <label for="descrip_inc">Descripción de la incidencia<span class="text-danger"> *</span></label>
                <textarea data-name="Descripción del incidente" placeholder="Descripción del incidente" class="form-control" rows="6" cols="50" id="descrip_inc" name="descrip_inc" placeholder="Escribe aquí..." style="resize: none;"></textarea>
                <p class="fs-10 mb-0">Describa con detalle, la incidencia reportada</p>
            </div>
            <br>  
            <div class="mb-3">
                    <label for="evidencia">Evidencia<span class="text-danger"> *</span></label>
                    <form action="Views/Resources/php/enviarreporte_de_incidencias.php" name="evidencia" id="evidencia" class="dropzone dropzone-multiple p-0" id="my-awesome-dropzone" enctype="multipart/form-data">
                        <div id="my-dropzone" class="dropzone">
                            <div class="dz-message">
                                <img src="Views/Resources/assets/img/icons/cloud-upload.svg" width="25"  alt=""> <!-- Ícono local -->
                                <p>Arrastre y suelte archivos aquí.</p>
                            </div>
                        </div>
                    </form>
                    <p class="fs-10 mb-0">Hasta 3 imágenes, 5MB cada una. Formatos aceptados: jpg, jpeg, png</p>
                </div>
                <br>  
                <div class="form-group">
                    <label for="fecha_atencion">Fecha de atención<span class="text-danger"> *</span></label>
                    <input data-name="Fecha de atención" class="form-control datetimepicker" type="date" id="fecha_atencion" name="fecha_atencion" type="text" placeholder="dd/mm/yy" data-options='{"disableMobile":true}' />   
                    <p class="fs-10 mb-0">Fecha en la que se atendió la incidencia</p>
                </div>
                <br>  
                <div class="form-group">
                    <label for="firma_de_conformidad">Firma de conformidad<span class="text-danger"> *</span></label>
                    <textarea name="firma_de_conformidad" id="firma_de_conformidad" class="form-control" rows="5" placeholder="" readonly></textarea>
                </div>
                <br>  


                <button type="button" id="prevButton" class="btn btn-primary" onclick="prevStep()">Anterior</button>
                <button type="button" id="verifyButton'" class="btn btn-primary" onclick="validateAndShowPreview()">Verificar respuestas</button>
        </div>

        <!-- Preview Section -->
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
                            <td><strong class="text-primary">Fecha de reporte:</strong></td>
                            <td><span id="preview_fecha_reporte" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">¿Qué tipo de incidencia reporta?:</strong></td>
                            <td><span id="preview_tipo_inc" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">¿En qué departamento o área de la organización se tiene esta incidencia</strong></td>
                            <td><span id="preview_dep_rep" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Descripción de la incidencia:</strong></td>
                            <td><span id="preview_descrip_inc" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Evidencia:</strong></td>
                            <td id="preview_evidencia_container"></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Fecha de atención:</strong></td>
                            <td><span id="preview_fecha_atencion" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Firma de conformidad:</strong></td>
                            <td><img id="preview_firma_de_conformidad" style="display:none; max-width:100%; height:auto;"></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <button type="button" class="btn btn-secondary" onclick="hidePreview()">Editar respuestas</button>
                <button id="sendEmail"  type="button" class="btn btn-success" onclick="submitForm()">Enviar formulario</button>
            </div>


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
                            <form id="extraEmailsForm" data-form-name="repIncidencias" onsubmit="saveEmails(event)">
                                <div id="emailsContainer">
                                    <!-- Los campos de correo se agregarán aquí -->
                                </div>
                                <button type="button" class="btn btn-secondary" onclick="addEmailField()">Agregar otro correo</button>
                                <button type="submit" class="btn btn-primary">Guardar correos</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    </div> 
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="emailsModalLabel">Agregar Correos Adicionales</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="extraEmailsForm" onsubmit="saveEmails(event)">
                            <input type="hidden" id="formName" value="repIncidencias">
                                <div id="emailsContainer">
                                    <!-- Los campos de correo se agregarán aquí -->
                                </div>
                                <button type="button" class="btn btn-secondary" onclick="addEmailField()">Agregar otro correo</button>
                                <button type="submit" class="btn btn-primary">Guardar correos</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
</div>
<br>
<br>
<br>


        <script defer src="Views/Resources/js/repInci.js"></script>
        <script src="Views/Resources/vendors/dropzone/dropzone-min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


        <script> 
        function validateForm() {
            var isValid = true;
            var errorMessages = [];
            var fields = [
                'tipo_inc',
                'dep_rep',
                'descrip_inc',
                'fecha_atencion'
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