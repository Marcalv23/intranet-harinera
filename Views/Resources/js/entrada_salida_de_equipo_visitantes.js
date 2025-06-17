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

    window.showPreview = function () {
        try {
            // Actualiza la vista previa de los datos generales del formulario
            const fecha_de_solicitud = document.getElementById('fecha_de_solicitud').value;
            const nombre_empresa = document.getElementById('nombre_empresa').value;
            const nombre_visitante = document.getElementById('nombre_visitante').value;
            const correo = document.getElementById('correo').value;
            const telefono = document.getElementById('telefono').value;
            const folio = document.getElementById('folio').value;
            const prioridad = document.getElementById('prioridad').value;
            const entrada_o_salida = document.getElementById('entrada_o_salida').value;
            const fecha_devolucion = document.getElementById('fecha_devolucion').value;
            const fines_utilizacion = document.getElementById('fines_utilizacion').value;
            const nombre_responsable = document.getElementById('nombre_responsable').value;
            const firma_de_responsable = document.getElementById('firma_de_responsable').value;
            const nombre_aut_ho = document.getElementById('nombre_aut_ho').value;
            const correo_aut_ho = document.getElementById('correo_aut_ho').value;
            const firma_aut_ho = document.getElementById('firma_aut_ho').value;
        
            document.getElementById('preview_fecha_de_solicitud').textContent = fecha_de_solicitud;
            document.getElementById('preview_nombre_empresa').textContent = nombre_empresa;
            document.getElementById('preview_nombre_visitante').textContent = nombre_visitante;
            document.getElementById('preview_correo').textContent = correo;
            document.getElementById('preview_telefono').textContent = telefono;
            document.getElementById('preview_folio').textContent = folio;
            document.getElementById('preview_prioridad').textContent = prioridad;
            document.getElementById('preview_entrada_o_salida').textContent = entrada_o_salida;
            document.getElementById('preview_fecha_devolucion').textContent = fecha_devolucion;
            document.getElementById('preview_fines_utilizacion').textContent = fines_utilizacion;
            document.getElementById('preview_nombre_responsable').textContent = nombre_responsable;
            document.getElementById('preview_firma_de_responsable').textContent = firma_de_responsable;
            document.getElementById('preview_nombre_aut_ho').textContent = nombre_aut_ho;
            document.getElementById('preview_correo_aut_ho').textContent = correo_aut_ho;
            document.getElementById('preview_firma_aut_ho').textContent = firma_aut_ho;
        
            // Obtén la tabla dinámica y la tabla de vista previa
            const dynamicTable = document.getElementById('dynamicTable').getElementsByTagName('tbody')[0];
            const previewDynamicTable = document.getElementById('preview_dynamicTable');
            const previewTbody = previewDynamicTable.querySelector('tbody');
        
            if (previewTbody) {
                previewTbody.innerHTML = ''; // Limpia el contenido previo
        
                // Itera sobre las filas de la tabla dinámica
                for (let i = 0; i < dynamicTable.rows.length; i += 2) { // Incrementa de 2 en 2 para emparejar las filas
                    const row = dynamicTable.rows[i];
                    const radioRow = dynamicTable.rows[i + 1];
                    if (row.parentNode.tagName === 'TBODY') { // Asegúrate de que solo copias filas del tbody
                        const newRow = previewTbody.insertRow();
                        const cells = row.cells;
        
                        // Itera sobre las celdas de cada fila
                        for (let j = 0; j < cells.length; j++) {
                            const cell = cells[j];
                            if (cell.querySelector('button')) {
                                continue; // Ignorar la celda del botón "Eliminar"
                            }
        
                            const newCell = newRow.insertCell();
        
                            // Manejo de <select> y <input>
                            if (cell.querySelector('select')) {
                                // Copia el valor seleccionado del <select>
                                const select = cell.querySelector('select');
                                newCell.textContent = select.options[select.selectedIndex].text;
                            } else if (cell.querySelector('input[type="text"]')) {
                                // Copia el valor de los campos de texto
                                const input = cell.querySelector('input[type="text"]');
                                newCell.textContent = input.value;
                            } else {
                                // Copia el texto de las celdas normales
                                newCell.textContent = cell.textContent;
                            }
                        }
        
                        // Manejo de los radio buttons
                        const radioCell = radioRow.cells[0];
                        const radios = radioCell.querySelectorAll('input[type="radio"]');
                        const newRadioCell = newRow.insertCell();
                        newRadioCell.classList.add('radio-buttons');
                        
                        radios.forEach(radio => {
                            if (radio.checked) {
                                const label = document.createElement('label');
                                label.textContent = radio.value === 'si' ? 'Si' : 'No';
                                newRadioCell.appendChild(label);
                            }
                        });
                    }
                }
            }

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
        
            // Mostrar la sección de vista previa
            const formSteps = document.querySelectorAll('.form-step');
            formSteps.forEach(step => step.style.display = 'none');
            document.getElementById('previewSection').style.display = 'block';
        
        } catch (error) {
            console.error('Error en la función showPreview:', error);
            alert('Ocurrió un error al mostrar la vista previa. Por favor, revise la consola para más detalles.');
        }
    };
    
    window.hidePreview = function () {
        document.getElementById('previewSection').style.display = 'none';
        showStep(currentStep); // Restaurar el paso actual del formulario
    };

// Función para obtener las características del equipo y formatearlas como HTML
window. getCaracteristicas = function() {
    var table = document.getElementById('dynamicTable');
    var rows = table.getElementsByTagName('tr');
    var caracteristicasHTML = '';

    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td');
        if (cells.length > 0) {
            var tipo_equipo = cells[0].textContent;
            var marca = cells[1].textContent;
            var modelo = cells[2].textContent;
            var num_serie = cells[3].textContent;

            caracteristicasHTML += '<tr>';
            caracteristicasHTML += '<td>' + tipo_equipo + '</td>';
            caracteristicasHTML += '<td>' + marca + '</td>';
            caracteristicasHTML += '<td>' + modelo + '</td>';
            caracteristicasHTML += '<td>' + num_serie + '</td>';
            caracteristicasHTML += '<td>' + pertenece_a_ho + '</td>';
            
            caracteristicasHTML += '</tr>';
        }
    }

    return caracteristicasHTML;
}

    window.editForm = function() {
        // Ocultar la vista previa y mostrar la sección anterior del formulario
        document.getElementById('preview').style.display = 'none';
        if (currentStep > 0) {
            showStep(currentStep - 1);
        } else {
            console.error('No se puede retroceder más, ya estás en el primer paso del formulario.');
        }
    };

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
    
        // Recoge los valores de la tabla dinámica
        const dynamicTable = document.getElementById('dynamicTable');
        if (dynamicTable) {
            const dynamicRows = dynamicTable.querySelectorAll('tbody tr');
    
            dynamicRows.forEach((row, index) => {
                if (index % 2 === 0) { // Solo procesa las filas con inputs
                    const tipo_equipo = row.querySelector('select[name="tipo_equipo[]"]')?.value || '';
                    const marca = row.querySelector('input[name="marca[]"]')?.value || '';
                    const modelo = row.querySelector('input[name="modelo[]"]')?.value || '';
                    const numero_serie = row.querySelector('input[name="numero_serie[]"]')?.value || '';
    
                    // Recoge la fila de radio buttons asociada
                    const radioRow = dynamicRows[index + 1];
                    const pertenece_a_ho = radioRow.querySelector('input[name^="pertenece_a_ho_"]:checked')?.value || '';
    
                    formData.append(`tipo_equipo[${index / 2}]`, tipo_equipo);
                    formData.append(`marca[${index / 2}]`, marca);
                    formData.append(`modelo[${index / 2}]`, modelo);
                    formData.append(`numero_serie[${index / 2}]`, numero_serie);
                    formData.append(`pertenece_a_ho[${index / 2}]`, pertenece_a_ho);
                }
            });
        }
    
        // Registro de datos en el FormData
        for (var pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }
    
        // Agregar campos adicionales a formData
        formData.append('fecha_de_solicitud', document.getElementById('fecha_de_solicitud').value);
        formData.append('nombre_empresa', document.getElementById('nombre_empresa').value);
        formData.append('nombre_visitante', document.getElementById('nombre_visitante').value);
        formData.append('correo', document.getElementById('correo').value);
        formData.append('telefono', document.getElementById('telefono').value);
        formData.append('folio', document.getElementById('folio').value);
        formData.append('prioridad', document.getElementById('prioridad').value);
        formData.append('entrada_o_salida', document.getElementById('entrada_o_salida').value);
        formData.append('fecha_devolucion', document.getElementById('fecha_devolucion').value);
        formData.append('fines_utilizacion', document.getElementById('fines_utilizacion').value);
        formData.append('nombre_responsable', document.getElementById('nombre_responsable').value);
        formData.append('firma_de_responsable', document.getElementById('firma_de_responsable').value);
        formData.append('nombre_aut_ho', document.getElementById('nombre_aut_ho').value);
        formData.append('correo_aut_ho', document.getElementById('correo_aut_ho').value);
        formData.append('firma_aut_ho', document.getElementById('firma_aut_ho').value);
    
        // Crea una solicitud AJAX para enviar los datos al script PHP
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'Views/Resources/php/enviarentrada_salida_visitante.php', true);
    
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
                    console.error('Formulario enviado correctamente:', e);
                    alert('Formulario enviado correctamente.');
                }
            } else {
                console.error('Error al enviar la solicitud AJAX:', xhr.statusText);
                alert('Error inesperado al intentar enviar el formulario.');
            }
        };
    
        // Envía los datos del formulario
        xhr.send(formData);
    });
    
    

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
    
        const fechaPedidoInput = document.getElementById('fecha_de_solicitud');
        fechaPedidoInput.value = fechaPedido;
    }
    
    setFechaPedido();
    setInterval(updateDateTime, 1000);
    updateDateTime();

    let rowCount = 1;

    window.addRow = function () {
        const table = document.getElementById('dynamicTable').getElementsByTagName('tbody')[0];
        
        // First row with inputs
        const newRow = table.insertRow();
        newRow.innerHTML = `
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
            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Eliminar</button></td>
        `;
        
        // Second row with radio buttons
        const newRadioRow = table.insertRow();
        newRadioRow.classList.add('radioRow');
        newRadioRow.innerHTML = `
            <td colspan="5">
                <label>¿Este equipo pertenece a HO?<span class="text-danger"> *</span></label>
                <div>
                    <input type="radio" class="form-check-input me-2" name="pertenece_a_ho_${rowCount}" value="si" required>Si
                    <input type="radio" class="form-check-input me-2" name="pertenece_a_ho_${rowCount}" value="no" required>No
                </div>
            </td>
        `;
        
        rowCount++;
    }
    
    window.removeRow = function (button) {
        const row = button.parentNode.parentNode;
        const radioRow = row.nextElementSibling;
    
        row.parentNode.removeChild(row);
        
        if (radioRow && radioRow.classList.contains('radioRow')) {
            radioRow.parentNode.removeChild(radioRow);
        }
    }


   // Generate unique folio and set it to read-only input
   const folioInput = document.getElementById('folio');
   if (folioInput) {
       generateUniqueFolio('esvisitantes'); // Cambia 'tableName' al nombre de tu tabla específica
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
            <input data-form-name="ESVisitantes" type="email" class="form-control" name="extraEmail[]" value="${email}" placeholder="Correo adicional" required>
            <div class="input-group-append">
            <button class="btn btn-outline-secondary" data-form-name="ESVisitantes" data-email="${email}" type="button" onclick="editEmail(this)">Editar</button>
            <button class="btn btn-outline-danger" data-form-name="ESVisitantes" data-email="${email}" type="button" onclick="removeEmailField(this)">Eliminar</button>
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

        if (formName !== 'ESVisitantes') {
            alert('Este correo no se puede editar porque no pertenece a ESVisitantes.');
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
    
        if (formName !== 'ESVisitantes') {
            alert('Este correo no se puede eliminar porque no pertenece a ESVisitantes.');
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

    $('#exampleModal').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget); // Botón que abrió el modal
        const formName = button.data('form-name'); // Nombre del formulario asociado
    
        if (formName) {
            // Establecer el formName en el campo oculto
            document.getElementById('formName').value = formName;
    
            // Cargar correos electrónicos
            window.loadEmails(formName);
        } else {
            console.error('No se ha proporcionado un nombre de formulario válido.');
        }
    });


});