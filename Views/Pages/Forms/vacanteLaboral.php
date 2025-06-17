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


<!DOCTYPE html>
<html lang="en">
<div class="card mb-3">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Postulación a vacante laboral</title>
  <link rel="stylesheet" href="Views/Resources/css/postulacionVacante.css"> 
  <link href="Views/Resources/vendors/dropzone/dropzone.css" rel="stylesheet" />
</head>
<body>

  <div class="card-body col-md-8 mx-auto">
      <form id="form2" onsubmit="event.preventDefault(); showPreview();">
        <div class="logo ">
            <img src="https://www.harineradeoriente.mx/wp-content/uploads/2023/09/1200-X-630.png">
        </div>
         <!-- Paso 1 -->
          <div class="form-step form-step-active col-md-8 mx-auto">
            <div class="">
                <h1 class="text-primary">Postulación a vacante laboral </h1> 
             </div>
            <div class=" ">
            Somos una empresa harinera orgullosamente mexicana que, desde nuestros inicios en 1958, se ha dedicado a la fabricación y comercialización de harina de trigo, maíz blanco, harina de maíz y harinas preparadas de la mejor calidad.
            </div>
            <div class=" ">
            <strong>Nuestras certificaciones</strong>
            <ul>
                <li>ISO 9001:2015</li>
                <li>ISO 22000:2018</li>
                <li>EMPRESAS POBLANAS DE 10</li>
                <li>Certificación Kosher</li>
            </ul>
        </div>
              <div class="form-group">
                  <label for="puesto_postula">Puesto al que postula<span class="text-danger"> *</span></label>
                  <input data-name="Puesto al que postula"type="text" class="form-control" id="puesto_postula" placeholder="Puesto al que postula" required>
                  <p class="fs-10 mb-0">Escriba el nombre del puesto a postular</p>
              </div>
              <br>
              <div class="form-group">
                  <label for="cv_carga">Cargue su CV actualizado<span class="text-danger"> *</span></label>
                  <form action="" name="cv" id="cv" class="dropzone dropzone-multiple p-0" id="my-awesome-dropzone" enctype="multipart/form-data">
                    <div id="my-dropzone" class="dropzone">
                        <div class="dz-message">
                            <img src="Views/Resources/assets/img/icons/cloud-upload.svg" width="25"  alt=""> <!-- Ícono local -->
                            <p>Arrastre y suelte archivos aquí.</p>
                        </div>
                    </div>
                    <p class="fs-10 mb-0">Suba un archivo en formato PDF o DOCX, de máximo 2MB</p>
                </form>
              </div>
              <br>
              
              <button type="button" class="btn btn-primary" onclick="nextStep()">Siguiente</button>
                <?php if ($user_role == 'administrador'): ?>
                <button type="button" class="btn btn-secondary" data-form-name="vacanteLaboral" data-toggle="modal" data-target="#exampleModal">
                    Añadir más correos
                </button>
                <?php endif; ?>
            </div>
  
          <!-- Paso 2 -->
          <div class="form-step form-step-active col-md-8 mx-auto">
            <div class="form-group">
                <label for="nombre_completo">Nombre completo<span class="text-danger"> *</span></label>
                <div class="input-group">
                    <div class="input-field">
                        <input data-name="Nombre" type="text" class="form-control" id="nombre" placeholder="Nombre(s)" required>
                        <p class="fs-10 mb-0">Nombre(s)</p>
                    </div>
                    <div class="input-field">
                        <input data-name="Apellido"type="text" class="form-control" id="apellido" placeholder="Apellido" required>
                        <p class="fs-10 mb-0">Apellido</p>
                    </div>
                </div>
            </div>
            <br>
            <br>
              <div class="form-group">
                  <label for="edad">Edad<span class="text-danger"> *</span></label>
                  <input data-name="Edad" type="text" class="form-control" id="edad" placeholder="Edad" required>
              </div>
              <br>
              <div class="form-group">
                  <label for="sexo">Sexo<span class="text-danger"> *</span></label>
                  <select data-name="Sexo" class="form-select" id="sexo" required>
                      <option value="">-- Seleccione --</option>
                      <option value="Femenino">Femenino</option>
                      <option value="Masculino">Masculino</option>
                      <option value="Prefiero no decir">Prefiero no decir</option>
                  </select>
                  <p class="fs-10 mb-0">Seleccione una opción</p>
              </div>
              <br>
              <div class="form-group">
                  <label for="correo">Correo electrónico<span class="text-danger"> *</span></label>
                  <input data-name="Correo electrónico" type="email" class="form-control" id="correo" placeholder="Correo electrónico" required>
                  <p class="fs-10 mb-0">Introduza un correo electrónico de contacto</p>
                </div>
                <br>
              <div class="form-group">
                  <label for="telefono">Número de teléfono<span class="text-danger"> *</span></label>
                  <input data-name="Número de teléfono" type="tel" class="form-control" id="telefono" placeholder="(000) 000-0000" required>
                  <p class="fs-10 mb-0">Introduzca un número de teléfono de contacto</p>
                </div>
                <br>
              <div class="form-group">
                  <label for="direccion">Dirección<span class="text-danger"> *</span></label>
                  <input data-name="Dirección" type="text" class="form-control" id="direccion" placeholder="Calle y número" required>
                  <p class="fs-10 mb-0">Calle y número</p>
                  <input data-name="Calle y número" type="text" class="form-control mt-2" id="colonia" placeholder="Colonia" required>
                  <p class="fs-10 mb-0">Colonia</p>
                  <div class="input-field">
                    <div class="input-group">
                        <div class="input-field">
                            <input data-name="Ciudad"type="text" class="form-control mt-2" id="ciudad" placeholder="Ciudad" required>
                            <p class="fs-10 mb-0">Ciudad</p>
                        </div>
                        <div class="input-field">
                            <input data-name="Estado / Provincia" type="text" class="form-control mt-2" id="estado" placeholder="Estado/Provincia" required>
                            <p class="fs-10 mb-0">Estado / Provincia</p>
                        </div>
                    </div>
                  <input data-name="Código postal" type="text" class="form-control mt-2" id="codigo_postal" placeholder="Código postal" required>
                  <p class="fs-10 mb-0">Código postal</p>
                </div>
                <br>
                <br>
              <button type="button" class="btn btn-primary" onclick="prevStep()">Anterior</button>
              <button type="button" class="btn btn-primary" onclick="nextStep()">Siguiente</button>
                </div>
            </div>
  
          <!-- Paso 3 -->
          <div class="form-step form-step-active col-md-8 mx-auto">
              <div class="form-group">
                  <label for="institucion_academica">Institución académica de donde proviene<span class="text-danger"> *</span></label>
                  <input type="text" class="form-control" id="institucion_academica" placeholder="Institución académica" required>
              </div>
              <br>
              <div class="form-group">
                  <label for="grado_estudio">Grado de estudio<span class="text-danger"> *</span></label>
                  <select data-name="Grado de estudio" class="form-select" id="grado_estudio" required>
                      <option value="">-- Seleccione --</option>
                      <option value="Maestría">Maestría</option>
                      <option value="Licenciatura y/o Ingeniería">Licenciatura y/o Ingeniería</option>
                      <option value="Técnico Superior Universitario">Técnico Superior Universitario</option>
                      <option value="Preparatoria y/o Bachiller">Preparatoria y/o Bachiller</option>
                      <option value="Secundaria">Secundaria</option>
                      <option value="Primaria">Primaria</option>
                      <option value="Ninguna de las anteriores">Ninguna de las anteriores</option>
                  </select>
              </div>
              <br>
              <div class="form-group">
                  <label for="nombre_carrera">Nombre de la carrera (en caso de que aplique)<span class="text-danger"> *</span></label>
                  <input type="text" class="form-control" id="nombre_carrera" placeholder="Nombre de la carrera" required>
              </div>
              <br>
              <div class="form-group">
                  <label for="experiencia_laboral">Experiencia laboral<span class="text-danger"> *</span></label>
                  <select data-name="Experiencia laboral" class="form-select" id="experiencia_laboral" required>
                      <option value="">-- Seleccione --</option>
                      <option value="Sin experiencia">Sin experiencia</option>
                      <option value="De 1 a 5 años">De 1 a 5 años</option>
                      <option value="De 5 años en adelante">De 5 años en adelante</option>
                  </select>
              </div>
              <br>
              <div class="form-group">
                  <label for="experiencia_puesto">Experiencia en el puesto solicitado<span class="text-danger"> *</span></label>
                  <textarea data-name="Experiencia en el puesto solicitado" data-name="Experiencia en el puesto solicitado" placeholder="Experiencia en el puesto solicitado" class="form-control" rows="6" cols="50" id="exp_soli" name="exp_soli" style="resize: none;"type="text" class="form-control" id="experiencia_puesto" placeholder="Experiencia en el puesto solicitado" required></textarea>
                  <p class="fs-10 mb-0">Describe brevemente la experiencia laboral o profesional que tienes con respecto al puesto postulado</p>
                </div>
                <br>
                <br>

              <button type="button" class="btn btn-primary" onclick="prevStep()">Anterior</button>
              <button type="button" class="btn btn-primary" onclick="nextStep()">Siguiente</button>
          </div>
  
          <!-- Paso 4 -->
          <div class="form-step form-step-active col-md-8 mx-auto">
              <div class="form-group">
                  <label>Documentación con la que cuenta<span class="text-danger"> *</span></label><br>
                    <div>
                    <input class="form-check-input" type="checkbox" id="cv_documento" value="Curriculum Vitae y/o solicitud de empleo">
                    <label class="form-check-label" for="cv_documento">Curriculum Vitae y/o solicitud de empleo</label>  
                    </div> 
                    <div>
                        <input class="form-check-input" type="checkbox" id="constancia_documento" value="Constancia de Situación Fiscal">
                        <label class="form-check-label" for="constancia_documento">Constancia de Situación Fiscal</label>
                    </div> 
                    <div>
                        <input class="form-check-input" type="checkbox" id="nss_documento" value="Número de Seguridad Social">
                        <label class="form-check-label" for="nss_documento">Número de Seguridad Social</label>
                    </div>
                    <div>
                        <input class="form-check-input" type="checkbox" id="curp_documento" value="CURP">
                        <label class="form-check-label" for="curp_documento">CURP</label>
                    </div>
              </div>
              <br>
              <div class="form-group">
                  <label for="tipo_licencia">Tipo de licencia vigente<span class="text-danger"> *</span></label>
                  <select class="form-control" id="tipo_licencia" required>
                      <option value="">-- Seleccione --</option>
                      <option value="Federal">Federal</option>
                      <option value="Mercantil">Mercantil</option>
                      <option value="Particular">Particular</option>
                      <option value="No aplica">No aplica</option>
                  </select>
              </div>
              <br>
              <div class="form-group">
                  <label>¿Algún pariente o conocido trabaja en esta empresa?<span class="text-danger"> *</span></label><br>
                  <select class="form-control" id="pariente" required>
                    <option value="">-- Seleccione --</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                </select>
              </div>
              <br>
              <div class="form-group">
                  <label for="nombre_pariente">¿Cuál es su nombre y parentesco?</label>
                  <input type="text" class="form-control" id="nombre_pariente" placeholder="Nombre y parentesco">
              </div>
              <br>
              <br>
              <button type="button" class="btn btn-primary" onclick="prevStep()">Anterior</button>
              <button type="button" class="btn btn-primary" onclick="validateAndShowPreview()">Verificar respuestas</button>
          </div>
  
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
                        <td><strong class="text-primary">Puesto al que postula:</strong></td>
                        <td><span id="preview_puesto_postula" class="text-muted"></span></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary">Cargue su CV actualizado:</strong></td>
                        <td id="preview_cv_container"></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary">Nombre completo:</strong></td>
                        <td><span id="preview_nombre" class="text-muted"></span></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary">Apellido:</strong></td>
                        <td><span id="preview_apellido" class="text-muted"></span></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary">Edad:</strong></td>
                        <td><span id="preview_edad" class="text-muted"></span></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary">Sexo:</strong></td>
                        <td><span id="preview_sexo" class="text-muted"></span></td>
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
                        <td><strong class="text-primary">Dirección:</strong></td>
                        <td><span id="preview_direccion" class="text-muted"></span></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary">Calle y número</strong></td>
                        <td><span id="preview_colonia" class="text-muted"></span></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary">Ciudad:</strong></td>
                        <td><span id="preview_ciudad" class="text-muted"></span></td>
                    </tr>

                    <tr>
                        <td><strong class="text-primary">Estado / Provincia:</strong></td>
                        <td><span id="preview_estado" class="text-muted"></span></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary">Código postal:</strong></td>
                        <td><span id="preview_codigo_postal" class="text-muted"></span></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary">Institución académica de donde proviene:</strong></td>
                        <td><span id="preview_institucion_academica" class="text-muted"></span></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary">Grado de estudio:</strong></td>
                        <td><span id="preview_grado_estudio" class="text-muted"></span></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary">Nombre de la carrera:</strong></td>
                        <td><span id="preview_nombre_carrera" class="text-muted"></span></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary">Experiencia laboral:</strong></td>
                        <td><span id="preview_experiencia_laboral" class="text-muted"></span></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary">Experiencia en el puesto solicitado:</strong></td>
                        <td><span id="preview_exp_soli" class="text-muted"></span></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary">Documentación con la que cuenta:</strong></td>
                        <td><span id="preview_cv_documento" class="text-muted"></span></td>
                        <td><span id="preview_constancia_documento" class="text-muted"></span></td>
                        <td><span id="preview_nss_documento" class="text-muted"></span></td>
                        <td><span id="preview_curp_documento" class="text-muted"></span></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary">Tipo de licencia vigente:</strong></td>
                        <td><span id="preview_tipo_licencia" class="text-muted"></span></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary">¿Algún pariente o conocido trabaja en esta empresa?:</strong></td>
                        <td><span id="preview_pariente" class="text-muted"></span></td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary">¿Cuál es su nombre y parentesco?:</strong></td>
                        <td><span id="preview_nombre_pariente" class="text-muted"></span></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <button type="button" class="btn btn-secondary" onclick="hidePreview()">Editar respuestas</button>
            <button id="sendEmail"  type="button" class="btn btn-success" onclick="">Enviar formulario</button>
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
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="extraEmailsForm" data-form-name="vacanteLaboral" onsubmit="saveEmails(event)">
                    <div id="emailsContainer">
                        <!-- Los campos de correo se agregarán aquí -->
                    </div>
                    <button data-form-name="vacanteLaboral" type="button" class="btn btn-secondary" onclick="addEmailField()">Agregar otro correo</button>
                    <button data-form-name="vacanteLaboral" type="submit" class="btn btn-primary">Guardar correos</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


        <script src="Views/Resources/vendors/dropzone/dropzone-min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

        <script src="Views/Resources/js/vacanteLaboral.js"></script>



<script> 
    function validateForm() {
        var isValid = true;
        var errorMessages = [];
        var fields = [
            'puesto_postula',
            'nombre',
            'apellido',
            'edad',
            'sexo',
            'telefono',
            'direccion',
            'colonia',
            'ciudad',
            'estado',
            'codigo_postal',
            'institucion_academica',
            'grado_estudio',
            'experiencia_laboral',
            'exp_soli',
            'tipo_licencia',
            'pariente'
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

</body>
</html>