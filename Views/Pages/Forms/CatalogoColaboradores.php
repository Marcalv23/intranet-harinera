<div class="card mb-3">
            <head>
            <link rel="stylesheet" href="Views/Resources/css/catalogo_de_colaboradores.css"> 
            <!-- Contenido principal -->
            </head>

            <div class="card-header z-1 col-md-8 mx-auto">
                <header class="">
                    <h1 class="text-primary">F-GES-03 Catálogo de colaboradores REV. 01</h1>
                    <h5 class="text-600">Formulario de captura de colaboradores en HO</h5>
                </header>
            </div>
            <div class="card-body col-md-8 mx-auto">
                <form id="form1" onsubmit="event.preventDefault(); validateForm();">
                    <div class="col-md-8 mx-auto">
                        <label class="form-label" for="N_empleado">N de colaborador<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control form-control-sm" name="N_empleado" id="N_empleado" placeholder="Ejemplo: 1001" required>
                        <p class="fs-10 mb-0">Introduzca el número del colaborador</p>
                    </div>
                    <br>
                    <div class="col-md-8 mx-auto">
                        <label for="departamento">Departamento<span class="text-danger"> *</span></label>
                        <select class="form-select form-select-sm" id="departamento" required>
                            <option value="">--Seleccione--</option>
                            <option value="1">Administracion</option>
                            <option value="2">Laboratorio</option>
                            <option value="3">Mantenimiento industrial</option>
                            <option value="4">Taller automotriz</option>
                            <option value="5">Logística</option>
                            <option value="6">Sindicato</option>
                            <option value="7">Vigilancia</option>
                            <option value="8">Seguridad industrial</option>
                        </select>
                        <p class="fs-10 mb-0">Seleccione el departamento al que pertenece</p>
                    </div>
                    <br>
                    <div class="col-md-8 mx-auto">
                        <label for="Nom_colab">Nombre(s) de colaborador<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control form-control-sm" id="Nom_colab" placeholder="Ejemplo: Ana Rosario" required>
                        <p class="fs-10 mb-0">Introduzca el nombre o nombres</p>
                    </div>
                    <br>
                    <div class="col-md-8 mx-auto">
                        <label for="apellido_paterno">Apellido paterno<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control form-control-sm" id="apellido_paterno" placeholder="Ejemplo: Ruiz" required>
                        <p class="fs-10 mb-0">Introduzca el apellido paterno</p>
                    </div>
                    <br>
                    <div class="col-md-8 mx-auto">
                        <label for="apellido_materno">Apellido materno<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control form-control-sm" id="apellido_materno" placeholder="Ejemplo: Figueroa" required>
                        <p class="fs-10 mb-0">Introduzca el apellido materno</p>
                    </div>
                    <br>
                    <div class="col-md-8 mx-auto">
                        <label for="correo">Correo electrónico<span class="text-danger"> *</span></label>
                        <input type="email" class="form-control form-control-sm" id="correo" placeholder="Ejemplo: ana.ruiz@mailinator.com" required>
                        <p class="fs-10 mb-0">Introduzca el correo electrónico</p>
                    </div>
                    <br>
                    <div class="col-md-8 mx-auto">
                        <label for="numero">Número de teléfono de contacto<span class="text-danger"> *</span></label>
                        <input type="tel" class="form-control form-control-sm" id="numero" placeholder="(000) 000-0000" required>
                        <p class="fs-10 mb-0">Introduzca el número de teléfono de contacto</p>
                    </div>
                    <br>
                    <div class="col-md-8 mx-auto">
                        <label for="aviso">Aviso de privacidad<span class="text-danger"> *</span></label>
                        <div class="d-flex">
                            <input type="checkbox" class="form-check-input me-2" id="aceptarAviso" required>
                            <p class="fs-10 mb-0" id="avisoText">
                                La empresa COMPAÑIA HARINERA DE ORIENTE S.A. DE C.V. con domicilio ubicado en 
                                PROLONGACIÓN HÉROES DE NACOZARI # 8002 COLONIA ZONA INDUSTRIAL ANEXA 
                                A LA LOMA, C.P. 72230 PUEBLA, PUEBLA utilizará sus datos personales recabados 
                                con los siguientes fines:fines económicos, fines personales, fines laborales, fines 
                                sociales, fines educativos, fines bancarios,fines de marketing. Para mayor 
                                información sobre el tratamiento de sus datos personales usted puede acudir al 
                                siguiente domicilio: PROLONGACIÓN HÉROES DE NACOZARI # 8002 COLONIA ZONA 
                                INDUSTRIAL ANEXA A LA LOMA, C.P. 72230 PUEBLA, PUEBLA.
                            </p>
                        </div>
                    </div>
<br>
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="d-flex justify-content-start">
                                <button class="revisar-respuesta btn btn-primary me-2" type="button"  onclick="validateAndShowPreview()">Revisar las respuestas</button>
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#emailsModal">Agregar correos adicionales</button>
                            </div>
                        </div>
                    </div>
                </form>

                <div id="preview" class="table-responsive scrollbar" >
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
                            <td><strong class="text-primary">Número de empleado:</strong></td>
                            <td><span id="preview_N_empleado" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Departamento:</strong></td>
                            <td><span id="preview_departamento" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Nombre de colaborador:</strong></td>
                            <td><span id="preview_Nom_colab" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Apellido paterno:</strong></td>
                            <td><span id="preview_apellido_paterno" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Apellido materno:</strong></td>
                            <td><span id="preview_apellido_materno" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Correo electrónico:</strong></td>
                            <td><span id="preview_correo" class="text-muted"></span></td>
                        </tr>
                        <tr>
                            <td><strong class="text-primary">Número de teléfono de contacto:</strong></td>
                            <td><span id="preview_numero" class="text-muted"></span></td>
                        </tr>
                    </tbody>
                </table>
                    <button type="button" class="btn btn-secondary" onclick="editForm()">Editar respuestas</button>
                    <button type="button" class="btn btn-success" onclick="submitForm()">Enviar formulario</button>
                </div>
            </div>
        </div>

        <!-- Modal para agregar correos adicionales -->
        <div class="modal fade" id="emailsModal" tabindex="-1" aria-labelledby="emailsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="emailsModalLabel">Agregar Correos Adicionales</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="extraEmailsForm" onsubmit="saveEmails(event)">
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

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="Views/Resources/js/script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // Cargar correos guardados al abrir el modal
            $('#emailsModal').on('shown.bs.modal', function() {
                loadEmails();
            });
        });

        function validateForm() {
            var isValid = true;
            var errorMessages = [];
            var fields = [
                'N_empleado',
                'departamento',
                'Nom_colab',
                'apellido_paterno',
                'apellido_materno',
                'correo',
                'numero'
            ];

            fields.forEach(function(field) {
                var element = document.getElementById(field);
                if (!element.value.trim()) {
                    isValid = false;
                    errorMessages.push('Por favor, llene el campo ' + element.placeholder + '.');
                }
            });

            var avisoElement = document.getElementById('aceptarAviso');
            if (!avisoElement.checked) {
                isValid = false;
                errorMessages.push('Debe aceptar el aviso de privacidad.');
            }

            if (!isValid) {
                alert(errorMessages.join('\n'));
            }

            return isValid;
        }

        function validateAndShowPreview() {
            if (validateForm()) {
                showPreview();
            }
        }

        
    </script>
            <br>
            <br>