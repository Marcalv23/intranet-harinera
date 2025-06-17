 document.addEventListener('DOMContentLoaded', function () {
            const steps = document.querySelectorAll('.form-step');
            let currentStep = 0;

            window.showStep = function (step) {
                const formSteps = document.querySelectorAll('.form-step');
                formSteps.forEach((stepElement, index) => {
                    stepElement.style.display = index === step ? 'block' : 'none';
                });
                currentStep = step;
            }

            window.nextStep = function () {
                const formSteps = document.querySelectorAll('.form-step');
                if (currentStep < formSteps.length - 1) {
                    showStep(currentStep + 1);
                }
            }

            window.prevStep = function() {
                if (currentStep > 0) {
                    showStep(currentStep - 1);
                }
            }

            window.validateAndShowPreview =  function () {
                if (validateForm()) {
                    showPreview();
                }
            }

            // Definir la función hidePreview
            window.hidePreview = function () {
                    // Mostrar la primera sección del formulario y ocultar la vista previa
                    document.getElementById('preview').style.display = 'none';
                    showStep(0);
                }
                
                // Inicializar la vista con el primer paso
                document.addEventListener('DOMContentLoaded', () => {
                    showStep(0);
                });

            window.showPreview = function () {
                try {
                    const N_colaborador = document.getElementById('N_colaborador').value;
                    const departamento = document.getElementById('departamento').value;
                    const N_empleado = document.getElementById('N_empleado').value;
                    const Ape_paterno = document.getElementById('Ape_paterno').value;
                    const Ape_materno = document.getElementById('Ape_materno').value;
                    const correo = document.getElementById('correo').value;
                    const telefono = document.getElementById('telefono').value;
                    const folio = document.getElementById('folio').value;
                    const fecha_reporte = document.getElementById('fecha_reporte').value;
                    const tipo_inc = document.getElementById('tipo_inc').value;
                    const dep_rep = document.getElementById('dep_rep').value;
                    const descrip_inc = document.getElementById('descrip_inc').value;
                    const fecha_atencion = document.getElementById('fecha_atencion').value;
                    const firma_de_conformidad = document.getElementById('firma_de_conformidad').value;
            
                    document.getElementById('preview_N_colaborador').textContent = N_colaborador;
                    document.getElementById('preview_departamento').textContent = departamento;
                    document.getElementById('preview_N_empleado').textContent = N_empleado;
                    document.getElementById('preview_Ape_paterno').textContent = Ape_paterno;
                    document.getElementById('preview_Ape_materno').textContent = Ape_materno;
                    document.getElementById('preview_correo').textContent = correo;
                    document.getElementById('preview_telefono').textContent = telefono;
                    document.getElementById('preview_folio').textContent = folio;
                    document.getElementById('preview_fecha_reporte').textContent = fecha_reporte;
                    document.getElementById('preview_tipo_inc').textContent = tipo_inc;
                    document.getElementById('preview_dep_rep').textContent = dep_rep;
                    document.getElementById('preview_descrip_inc').textContent = descrip_inc;
                    document.getElementById('preview_fecha_atencion').textContent = fecha_atencion;
                    document.getElementById('preview_firma_de_conformidad').textContent = firma_de_conformidad;
            
                    // Mostrar todas las imágenes cargadas en el contenedor de vista previa
                    const previewEvidenciaContainer = document.getElementById('preview_evidencia_container');
                    previewEvidenciaContainer.innerHTML = ''; // Limpiar el contenedor de vista previa antes de agregar nuevas imágenes
            
                    const evidenceFiles = document.querySelectorAll('#my-dropzone .dz-preview img');
                    evidenceFiles.forEach(file => {
                        const img = document.createElement('img');
                        img.src = file.src;
                        img.style.width = '100px'; // Ajustar el tamaño según sea necesario
                        img.style.margin = '5px';  // Espaciado entre imágenes
                        previewEvidenciaContainer.appendChild(img);
                    });
            
                    // Ocultar pasos del formulario y mostrar la vista previa
                    const formSteps = document.querySelectorAll('.form-step');
                    formSteps.forEach(step => step.style.display = 'none');
            
                    document.getElementById('preview').style.display = 'block';
                } catch (error) {
                    console.error('Error in showPreview function:', error);
                    alert('Ocurrió un error al mostrar la vista previa. Por favor, revise la consola para más detalles.');
                }
            };
            

            window.editForm = function () {
                // Mostrar la primera sección del formulario y ocultar la vista previa
                document.getElementById('preview').style.display = 'none';
                showStep(0);
            }
            
            // Inicializar la vista con el primer paso
            showStep(0);

            Dropzone.autoDiscover = false;

            const myDropzone = new Dropzone("#my-dropzone", {
                url: "#", // No necesita URL de carga ya que se maneja solo en frontend
                addRemoveLinks: true, // Añade enlaces para eliminar archivos
                dictRemoveFile: 'Remove',
                maxFilesize: 5, // Tamaño máximo del archivo en MB
                parallelUploads: 3, // Número máximo de archivos que se pueden cargar al mismo tiempo
                autoProcessQueue: false, // No procesar automáticamente ya que no interactuamos con el servidor
                maxFiles: 3, // Número máximo de archivos permitidos
                acceptedFiles: "image/jpeg,image/png,image/jpg" // Extensiones permitidas
            });

            document.getElementById('sendEmail').addEventListener('click', function() {
                const formData = new FormData(document.getElementById('form2'));
            
                // Agregar archivos de Dropzone a formData
                myDropzone.getAcceptedFiles().forEach(function(file, index) {
                    formData.append('evidenceFiles[]', file, file.name);
                    console.log(`File ${index + 1}: Name = ${file.name}, Size = ${file.size} bytes, Type = ${file.type}`);
                });
            
                // Depuración: Mostrar el contenido de formData
                for (var pair of formData.entries()) {
                    if (pair[1] instanceof File) {
                        console.log(`${pair[0]}: ${pair[1].name}, Size: ${pair[1].size}, Type: ${pair[1].type}`);
                    } else {
                        console.log(`${pair[0]}: ${pair[1]}`);
                    }
                }
            
                // Crea una solicitud AJAX para enviar los datos al script PHP
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'Views/Resources/php/enviarreporte_de_incidencias.php', true);
            
                // Define qué hacer cuando la respuesta es recibida
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        try {
                            var response = JSON.parse(xhr.responseText);
                            if (response.message) {
                                alert(response.message); // Mensaje de éxito
                            } else if (response.error) {
                                alert(response.error); // Mensaje de error
                            }
                        } catch (e) {
                            alert('Formulario enviado correctamente.');
                        }
                    } else {
                        alert('Error inesperado al intentar enviar el formulario.');
                    }
                };
            
                // Envía los datos del formulario
                xhr.send(formData);
            });

           // Generate unique folio and set it to read-only input
            const folioInput = document.getElementById('folio');
            if (folioInput) {
                generateUniqueFolio('reinci'); // Cambia 'tableName' al nombre de tu tabla específica
            }

            function generateUniqueFolio(tableName) {
                fetch(`Views/Resources/php/folioController.php?action=getNewFolio&table=${encodeURIComponent(tableName)}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! Status: ${response.status}`);
                        }
                        return response.text(); // Obtén la respuesta como texto primero
                    })
                    .then(text => {
                        console.log('Response Text:', text); // Registra la respuesta cruda
                        try {
                            const data = JSON.parse(text); // Intenta analizar JSON
                            if (data.ultimoFolio !== undefined) {
                                const nuevoFolio = data.ultimoFolio + 1;
                                document.getElementById('folio').value = nuevoFolio;
                            } else if (data.error) {
                                console.error('Error al obtener el último folio:', data.error);
                            }
                        } catch (e) {
                            console.error('Error al analizar JSON:', e);
                        }
                    })
                    .catch(error => console.error('Error en la solicitud:', error));
            }

            



            function updateDateTime() {
                const now = new Date();
                const date = now.toLocaleDateString();
                const time = now.toLocaleTimeString();
            
                const datetimeElement = document.getElementById('datetime');
                if (datetimeElement) {
                    datetimeElement.textContent = `${date} ${time}`;
                }
            }
        
            function setFechaPedido() {
                const now = new Date();
                const year = now.getFullYear();
                const month = String(now.getMonth() + 1).padStart(2, '0'); // Los meses empiezan desde 0
                const day = String(now.getDate()).padStart(2, '0');
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');
            
                const fechaPedido = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
            
                const fechaPedidoInput = document.getElementById('fecha_reporte');
                fechaPedidoInput.value = fechaPedido;
            }
            
            setFechaPedido();
            setInterval(updateDateTime, 1000);
            updateDateTime();

            // Función para agregar un campo de correo electrónico
                window.addEmailField = function (email = '') {
                    const container = document.getElementById('emailsContainer');
                    
                    // Contar el número actual de campos de correo electrónico
                    const currentFieldsCount = container.querySelectorAll('.form-group').length;
                    
                    // Verificar si ya se han agregado 8 campos
                    if (currentFieldsCount >= 8) {
                        alert('El límite de 8 correos electrónicos ha sido alcanzado.');
                        return; // No agregar un nuevo campo si el límite se ha alcanzado
                    }
                    
                    const emailField = document.createElement('div');
                    emailField.classList.add('form-group');
                    emailField.innerHTML = `
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="extraEmail[]" value="${email}" placeholder="Correo adicional" required>
                        <div class="input-group-append">
                        <button class="btn btn-outline-secondary" data-form-name="repIncidencias" data-email="${email}" type="button" onclick="editEmail(this)">Editar</button>
                        <button class="btn btn-outline-danger" data-form-name="repIncidencias" data-email="${email}" type="button" onclick="removeEmailField(this)">Eliminar</button>
                        </div>
                    </div>
                    `;
                    container.appendChild(emailField);
                }

                // Función para editar un correo electrónico
            window.editEmail = function (button) {
                const emailField = button.closest('.input-group').querySelector('input[type="email"]');
                const formName = button.dataset.formName; // Obtener el nombre del formulario desde el atributo del botón
                const oldEmail = button.dataset.email; // Obtener el correo antiguo desde el atributo del botón

                if (formName !== 'repIncidencias') {
                    alert('Este correo no se puede editar porque no pertenece a repIncidencias.');
                    return;
                }

                if (button.textContent === 'Editar') {
                    emailField.readOnly = false;
                    emailField.focus();
                    button.textContent = 'Guardar';
                } else {
                    emailField.readOnly = true;
                    const newEmail = emailField.value;
                    button.textContent = 'Editar';

                    fetch('Views/Resources/php/handleEmails.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams({
                            action: 'update',
                            old_email: oldEmail,
                            new_email: newEmail,
                            formName: formName // Incluir el nombre del formulario
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.success || data.error);
                        if (data.success) {
                            button.dataset.email = newEmail; // Actualiza el atributo con el nuevo correo
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
            }


                // Función para eliminar un campo de correo electrónico
                window.removeEmailField = function (button) {
                    const formName = button.dataset.formName; // Obtener el nombre del formulario desde el atributo del botón
                    const email = button.dataset.email; // Obtener el correo desde el atributo del botón
                
                    if (formName !== 'repIncidencias') {
                        alert('Este correo no se puede eliminar porque no pertenece a repIncidencias.');
                        return;
                    }
                
                    fetch('Views/Resources/php/handleEmails.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams({
                            action: 'delete',
                            email: email,
                            form_name: formName // Incluir el nombre del formulario
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.success || data.error);
                        if (data.success) {
                            // Eliminar el campo del modal
                            button.closest('.form-group').remove();
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }

                // Función para guardar correos electrónicos
                window.saveEmails = function (event) {
                    event.preventDefault(); // Evita que el formulario se envíe de manera predeterminada
                
                    const emails = [];
                    const emailFields = document.querySelectorAll('#extraEmailsForm input[name="extraEmail[]"]');
                    emailFields.forEach(field => {
                        if (field.value) {
                            emails.push(field.value);
                        }
                    });
                
                    const formName = document.getElementById('formName').value; // Obtiene el nombre del formulario
                
                    fetch('Views/Resources/php/handleEmails.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams({
                            action: 'insert',
                            emails: JSON.stringify(emails),
                            form_name: formName // Incluye el nombre del formulario en los datos enviados
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.success || data.error);
                        if (data.success) {
                            $('#exampleModal').modal('hide'); // Oculta el modal al guardar los correos
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }

                // Función para cargar correos electrónicos al mostrar el modal
                window.loadEmails = function (formName) {
                    fetch('Views/Resources/php/handleEmails.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams({
                            action: 'get',
                            form_name: formName
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const container = document.getElementById('emailsContainer');
                            container.innerHTML = '';
                            data.emails.forEach(email => {
                                window.addEmailField(email);
                            });
                        } else {
                            console.error('Error al cargar correos:', data.error);
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }

                // Configuración del evento para el modal
                $('#exampleModal').on('show.bs.modal', function (event) {
                    const button = $(event.relatedTarget); // Botón que abrió el modal
                    const formName = button.data('form-name'); // Nombre del formulario asociado

                    if (formName) {
                        window.loadEmails(formName);
                    } else {
                        console.error('No se ha proporcionado un nombre de formulario válido.');
                    }
                });
        
    });