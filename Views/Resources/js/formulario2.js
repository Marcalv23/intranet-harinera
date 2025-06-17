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
                const N_colaborador = document.getElementById('N_colaborador').value;
                const departamento = document.getElementById('departamento').value;
                const N_empleado = document.getElementById('N_empleado').value;
                const Ape_paterno = document.getElementById('Ape_paterno').value;
                const Ape_materno = document.getElementById('Ape_materno').value;
                const correo = document.getElementById('correo').value;
                const telefono = document.getElementById('telefono').value;
                const folio = document.getElementById('folio').value;
                const Prioridad = document.getElementById('Prioridad').value;
                const gestiona = document.getElementById('gestiona').value;
                const solicitando = document.getElementById('solicitando').value;
                const fecha_pedido = document.getElementById('fecha_pedido').value;
                const fecha_entrega = document.getElementById('fecha_entrega').value;
                const fines_utilizacion = document.getElementById('fines_utilizacion').value;
                const nombre_solicitud = document.getElementById('nombre_solicitud').value;
                const firma_solicitud = document.getElementById('firma_solicitud').value;
                const nombre_jefe = document.getElementById('nombre_jefe').value;
                const correo_jefe = document.getElementById('correo_jefe').value;
                const firma_jefe_recibe = document.getElementById('firma_jefe_recibe').value;
                const nombre_recibe = document.getElementById('nombre_recibe').value;
                const firma_recibe = document.getElementById('firma_recibe').value;
            
                // Mostrar la tabla dinámica en la vista previa
                const dynamicTable = document.getElementById('dynamicTable');
                const previewTable = document.getElementById('preview_dynamicTable');
            
                if (previewTable) {
                    let tableHtml = '<thead><tr><th>Partida</th><th>Cantidad</th><th>Unidad</th><th>Descripción</th></tr><tbody>';
            
                    const rows = dynamicTable.querySelectorAll('tbody tr');
                    rows.forEach((row) => {
                        const partidaInput = row.querySelector('input[name="partida[]"]');
                        const cantidadInput = row.querySelector('input[name="cantidad[]"]');
                        const unidadSelect = row.querySelector('select[name="unidad[]"]');
                        const descripcionTextarea = row.querySelector('textarea[name="descripcion[]"]');
            
                        const partida = partidaInput ? partidaInput.value : '';
                        const cantidad = cantidadInput ? cantidadInput.value : '';
                        const unidad = unidadSelect ? unidadSelect.value : '';
                        const descripcion = descripcionTextarea ? descripcionTextarea.value : '';
            
                        tableHtml += `<tr>
                            <td>${partida}</td>
                            <td>${cantidad}</td>
                            <td>${unidad}</td>
                            <td>${descripcion}</td>
                        </tr>`;
                    });
            
                    tableHtml += '</tbody>';
                    previewTable.innerHTML = tableHtml; // Actualizar tabla de vista previa
                } else {
                    console.error('El elemento preview_dynamicTable no existe.');
                }
            
                document.getElementById('preview_N_colaborador').textContent = N_colaborador;
                document.getElementById('preview_departamento').textContent = departamento;
                document.getElementById('preview_N_empleado').textContent = N_empleado;
                document.getElementById('preview_Ape_paterno').textContent = Ape_paterno;
                document.getElementById('preview_Ape_materno').textContent = Ape_materno;
                document.getElementById('preview_correo').textContent = correo;
                document.getElementById('preview_telefono').textContent = telefono;
                document.getElementById('preview_folio').textContent = folio;
                document.getElementById('preview_Prioridad').textContent = Prioridad;
                document.getElementById('preview_gestiona').textContent = gestiona;
                document.getElementById('preview_solicitando').textContent = solicitando;
                document.getElementById('preview_fecha_pedido').textContent = fecha_pedido;
                document.getElementById('preview_fecha_entrega').textContent = fecha_entrega;
                document.getElementById('preview_fines_utilizacion').textContent = fines_utilizacion;
                document.getElementById('preview_nombre_solicitud').textContent = nombre_solicitud;
                document.getElementById('preview_firma_solicitud').textContent = firma_solicitud;
                document.getElementById('preview_nombre_jefe').textContent = nombre_jefe;
                document.getElementById('preview_correo_jefe').textContent = correo_jefe;
                document.getElementById('preview_firma_jefe_recibe').textContent = firma_jefe_recibe;
                document.getElementById('preview_nombre_recibe').textContent = nombre_recibe;
                document.getElementById('preview_firma_recibe').textContent = firma_recibe;
            
                const formSteps = document.querySelectorAll('.form-step');
                formSteps.forEach(step => step.style.display = 'none');
            
                document.getElementById('preview').style.display = 'block';
            };
            
            
            

            window.editForm = function () {
                // Mostrar la primera sección del formulario y ocultar la vista previa
                document.getElementById('preview').style.display = 'none';
                showStep(0);
            }
            
            // Inicializar la vista con el primer paso
            document.addEventListener('DOMContentLoaded', () => {
                showStep(0);
            });

            window.submitForm = function () {
                // Recoge los valores del formulario
                var formData = new FormData(document.getElementById('form2'));
            
                // Recoge los valores de la tabla dinámica
                const dynamicTable = document.getElementById('dynamicTable');
                if (dynamicTable) {
                    const dynamicRows = dynamicTable.querySelectorAll('tbody tr');
            
                    dynamicRows.forEach((row, index) => {
                        const partida = row.querySelector('input[name="partida[]"]')?.value || '';
                        const cantidad = row.querySelector('input[name="cantidad[]"]')?.value || '';
                        const unidad = row.querySelector('select[name="unidad[]"]')?.value || ''; // Ajustado para select
                        const descripcion = row.querySelector('textarea[name="descripcion[]"]')?.value || ''; // Ajustado para textarea
            
                        formData.append(`partida[${index}]`, partida);
                        formData.append(`cantidad[${index}]`, cantidad);
                        formData.append(`unidad[${index}]`, unidad);
                        formData.append(`descripcion[${index}]`, descripcion);
                    });
                }
            
                // Crea una solicitud AJAX para enviar los datos al script PHP
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'Views/Resources/php/enviarsolicitudmercan.php', true);
            
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
            };
            
            
            

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
    
        const fechaPedidoInput = document.getElementById('fecha_pedido');
        fechaPedidoInput.value = fechaPedido;
    }
    
    setFechaPedido();
    setInterval(updateDateTime, 1000);
    updateDateTime();

window.rowCount = 1; // Inicializa un contador de filas al cargar la página

// Función para agregar una nueva fila a la tabla dinámica
window.addRow = function() {
    const table = document.getElementById('dynamicTable');
    table.style.display = 'table'; // Mostrar la tabla si estaba oculta

    const tbody = table.getElementsByTagName('tbody')[0];
    const lastRow = tbody.rows[tbody.rows.length - 1]; // Obtén la última fila actual
    const lastRowCount = lastRow ? parseInt(lastRow.cells[0].querySelector('input[type="text"][name="partida[]"]').value) : 0;

    const newRow = tbody.insertRow();

    const cell1 = newRow.insertCell(0);
    const cell2 = newRow.insertCell(1);
    const cell3 = newRow.insertCell(2);
    const cell4 = newRow.insertCell(3);
    const cell5 = newRow.insertCell(4);

    cell1.innerHTML = `<input type="text" class="form-control form-control-sm" name="partida[]" value="${lastRowCount + 1}" readonly style="width: 50px;">`;
    cell2.innerHTML = `<input type="number" class="form-control form-control-sm" name="cantidad[]" placeholder="Cantidad" min="0" maxlength="4" oninput="limitDigits(this, 4)" style="width: 70px;">`;
    cell3.innerHTML = `<select class="form-select form-select-sm" name="unidad[]" style="width: 80px;">
                            <option value="pza">pza.</option>
                            <option value="mt">mt.</option>
                            <option value="lt">lt.</option>
                            <option value="kg">kg.</option>
                            <option value="servicio">servicio</option>
                       </select>`;
    cell4.innerHTML = `<textarea class="form-control form-control-sm" name="descripcion[]" placeholder="Descripción" style="width: 200px;"></textarea>`;
    cell5.innerHTML = `<button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)">Eliminar</button>`;
};


// Función para limitar los dígitos del input de cantidad
window.limitDigits = function(element, maxDigits) {
    if (element.value.length > maxDigits) {
        element.value = element.value.slice(0, maxDigits);
    }
};


// Función para limitar los dígitos del input de cantidad
window.limitDigits = function(element, maxDigits) {
    if (element.value.length > maxDigits) {
        element.value = element.value.slice(0, maxDigits);
    }
};


// Función para eliminar una fila de la tabla dinámica
        window.deleteRow = function(button) {
            const row = button.closest('tr'); // Encuentra la fila más cercana al botón
            const tbody = row.parentNode;
            row.remove(); // Elimina la fila del DOM

            // Actualiza los números de partida después de eliminar la fila
            updateRowNumbers(tbody);

            // Oculta la tabla si ya no hay filas
            const table = document.getElementById('dynamicTable');
            if (tbody.rows.length === 0) {
                table.style.display = 'none';
            }
        };

// Función para actualizar los números de partida después de eliminar una fila
            function updateRowNumbers(tbody) {
                // Recorre todas las filas del tbody y actualiza los números de partida
                Array.from(tbody.rows).forEach((row, index) => {
                    const cell1 = row.cells[0];
                    if (cell1.querySelector('input[type="text"][name="numero"]')) {
                        cell1.querySelector('input[type="text"][name="numero"]').value = index + 1;
                    }
                });
            }

                    });


                    // Generate unique folio and set it to read-only input
            const folioInput = document.getElementById('folio');
            if (folioInput) {
                generateUniqueFolio('soliMercaServi'); // Cambia 'tableName' al nombre de tu tabla específica
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


            window.addEmailField = function (email = '') {
                const container = document.getElementById('emailsContainer');
                
                const currentFieldsCount = container.querySelectorAll('.form-group').length;
                
                if (currentFieldsCount >= 8) {
                    alert('El límite de 8 correos electrónicos ha sido alcanzado.');
                    return;
                }
                
                const emailField = document.createElement('div');
                emailField.classList.add('form-group');
                emailField.innerHTML = `
                    <div class="input-group mb-3">
                        <input data-form-name="SolicitudMercancia" type="email" class="form-control" name="extraEmail[]" value="${email}" placeholder="Correo adicional" required>
                        <div class="input-group-append">
                            <button class="btn btn-secondary" data-form-name="SolicitudMercancia" data-email="${email}" type="button" onclick="editEmail(this)">Editar</button>
                            <button class="btn btn-danger" data-form-name="SolicitudMercancia" data-email="${email}" type="button" onclick="removeEmailField(this)">Eliminar</button>
                        </div>
                    </div>
                `;
                container.appendChild(emailField);
            };
            
            window.editEmail = function (button) {
                const emailField = button.closest('.input-group').querySelector('input[type="email"]');
                const formName = button.dataset.formName;
                const oldEmail = button.dataset.email;
                
                if (formName !== 'SolicitudMercancia') {
                    alert('Este correo no se puede editar porque no pertenece a SolicitudMercancia.');
                    return;
                }
                
                if (button.textContent === 'Editar') {
                    emailField.readOnly = false;
                    emailField.focus();
                    button.textContent = 'Guardar';
                } else {
                    const newEmail = emailField.value;
                    
                    if (newEmail === oldEmail) {
                        emailField.readOnly = true;
                        button.textContent = 'Editar';
                        return;
                    }
            
                    emailField.readOnly = true;
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
                            formName: formName
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.success || data.error);
                        if (data.success) {
                            button.dataset.email = newEmail;
                        } else {
                            emailField.value = oldEmail;
                        }
                    })
                    .catch(error => {
                        emailField.value = oldEmail;
                    });
                }
            };
            
            


            window.removeEmailField = function (button) {
                const formName = button.dataset.formName;
                const email = button.dataset.email;
            
                if (formName !== 'SolicitudMercancia') {
                    alert('Este correo no se puede eliminar porque no pertenece a SolicitudMercancia.');
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
                        form_name: formName
                    })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.success || data.error);
                    if (data.success) {
                        button.closest('.form-group').remove();
                    }
                })
                .catch(error => console.error('Error:', error));
            };
            
            window.saveEmails = function (event) {
                event.preventDefault(); 
            
                const emails = [];
                const emailFields = document.querySelectorAll('#emailsContainer input[name="extraEmail[]"]');
            
                emailFields.forEach(field => {
                    if (field.value) {
                        emails.push(field.value);
                    }
                });
            
                const formName = document.getElementById('formName').value;
            
                if (emails.length === 0 || !formName) {
                    alert('No se proporcionaron correos electrónicos o nombre de formulario.');
                    return;
                }
            
                fetch('Views/Resources/php/handleEmails.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        action: 'insert',
                        emails: JSON.stringify(emails),
                        form_name: formName
                    })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.success || data.error);
                    if (data.success) {
                        $('#exampleModal').modal('hide'); 
                    }
                })
                .catch(error => console.error('Error:', error));
            };
            
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
            };
            
            $('#exampleModal').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget); 
                const formName = button.data('form-name'); 
            
                if (formName) {
                    document.getElementById('formName').value = formName;
                    window.loadEmails(formName);
                } else {
                    console.error('No se ha proporcionado un nombre de formulario válido.');
                }
            });



