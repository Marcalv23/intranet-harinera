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
                // Obtener los valores de los campos del formulario
                const puesto_postula = document.getElementById('puesto_postula').value;
                const nombre = document.getElementById('nombre').value;
                const apellido = document.getElementById('apellido').value;
                const edad = document.getElementById('edad').value;
                const sexo = document.getElementById('sexo').value;
                const correo = document.getElementById('correo').value;
                const telefono = document.getElementById('telefono').value;
                const direccion = document.getElementById('direccion').value;
                const colonia = document.getElementById('colonia').value;
                const ciudad = document.getElementById('ciudad').value;
                const estado = document.getElementById('estado').value;
                const codigo_postal = document.getElementById('codigo_postal').value;
                const institucion_academica = document.getElementById('institucion_academica').value;
                const grado_estudio = document.getElementById('grado_estudio').value;
                const nombre_carrera = document.getElementById('nombre_carrera').value;
                const experiencia_laboral = document.getElementById('experiencia_laboral').value;
                const tipo_licencia = document.getElementById('tipo_licencia').value;
                const pariente = document.getElementById('pariente').value;
                const nombre_pariente = document.getElementById('nombre_pariente').value;
        
                // Obtener los checkboxes seleccionados
                const cv_documento = document.getElementById('cv_documento').checked ? 'Curriculum Vitae y/o solicitud de empleo' : '';
                const constancia_documento = document.getElementById('constancia_documento').checked ? 'Constancia de Situación Fiscal' : '';
                const nss_documento = document.getElementById('nss_documento').checked ? 'Número de Seguridad Social' : '';
                const curp_documento = document.getElementById('curp_documento').checked ? 'CURP' : '';
        
                // Mostrar los datos en la vista previa
                document.getElementById('preview_puesto_postula').textContent = puesto_postula;
                document.getElementById('preview_nombre').textContent = nombre;
                document.getElementById('preview_apellido').textContent = apellido;
                document.getElementById('preview_edad').textContent = edad;
                document.getElementById('preview_sexo').textContent = sexo;
                document.getElementById('preview_correo').textContent = correo;
                document.getElementById('preview_telefono').textContent = telefono;
                document.getElementById('preview_direccion').textContent = direccion;
                document.getElementById('preview_colonia').textContent = colonia;
                document.getElementById('preview_ciudad').textContent = ciudad;
                document.getElementById('preview_estado').textContent = estado;
                document.getElementById('preview_codigo_postal').textContent = codigo_postal;
                document.getElementById('preview_institucion_academica').textContent = institucion_academica;
                document.getElementById('preview_grado_estudio').textContent = grado_estudio;
                document.getElementById('preview_nombre_carrera').textContent = nombre_carrera;
                document.getElementById('preview_experiencia_laboral').textContent = experiencia_laboral;
                document.getElementById('preview_tipo_licencia').textContent = tipo_licencia;
                document.getElementById('preview_pariente').textContent = pariente;
                document.getElementById('preview_nombre_pariente').textContent = nombre_pariente;
        
                // Mostrar los documentos seleccionados en la tabla
                document.getElementById('preview_cv_documento').textContent = cv_documento;
                document.getElementById('preview_constancia_documento').textContent = constancia_documento;
                document.getElementById('preview_nss_documento').textContent = nss_documento;
                document.getElementById('preview_curp_documento').textContent = curp_documento;
        
                // Mostrar todas las imágenes cargadas en el contenedor de vista previa
                const previewCvContainer = document.getElementById('preview_cv_container');
                previewCvContainer.innerHTML = ''; // Limpiar el contenedor de vista previa antes de agregar nuevos archivos
            
                const evidenceFiles = document.querySelectorAll('#my-dropzone .dz-preview');
                const fileNames = [];
                evidenceFiles.forEach(file => {
                    const fileName = file.querySelector('.dz-filename span').textContent;
                    fileNames.push(fileName); // Obtener el nombre del archivo
                });
                
                // Mostrar los nombres de los archivos en el contenedor de vista previa
                previewCvContainer.innerHTML = fileNames.join(', ');
        
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
        maxFilesize: 2, // Tamaño máximo del archivo en MB
        parallelUploads: 1, // Número máximo de archivos que se pueden cargar al mismo tiempo
        autoProcessQueue: false, // No procesar automáticamente ya que no interactuamos con el servidor
        maxFiles: 1, // Número máximo de archivos permitidos
        acceptedFiles: 'application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document' // Extensiones permitidas
    });
    
    document.getElementById('sendEmail').addEventListener('click', function() {
        const formData = new FormData(document.getElementById('form2'));
        
        // Agregar archivos de Dropzone a formData
        myDropzone.getAcceptedFiles().forEach(function(file) {
            formData.append('evidenceFiles[]', file, file.name);
        });
    
        // Agregar checkboxes seleccionados a formData
        const checkboxes = ['cv_documento', 'constancia_documento', 'nss_documento', 'curp_documento'];
        checkboxes.forEach(function(id) {
            const checkbox = document.getElementById(id);
            formData.append(id, checkbox.checked ? checkbox.value : '');
        });
    
        // Agregar campos adicionales a formData
        formData.append('puesto_postula', document.getElementById('puesto_postula').value);
        formData.append('nombre', document.getElementById('nombre').value);
        formData.append('apellido', document.getElementById('apellido').value);
        formData.append('edad', document.getElementById('edad').value);
        formData.append('sexo', document.getElementById('sexo').value);
        formData.append('correo', document.getElementById('correo').value);
        formData.append('telefono', document.getElementById('telefono').value);
        formData.append('direccion', document.getElementById('direccion').value);
        formData.append('colonia', document.getElementById('colonia').value);
        formData.append('ciudad', document.getElementById('ciudad').value);
        formData.append('estado', document.getElementById('estado').value);
        formData.append('codigo_postal', document.getElementById('codigo_postal').value);
        formData.append('institucion_academica', document.getElementById('institucion_academica').value);
        formData.append('grado_estudio', document.getElementById('grado_estudio').value);
        formData.append('nombre_carrera', document.getElementById('nombre_carrera').value);
        formData.append('experiencia_laboral', document.getElementById('experiencia_laboral').value);
        formData.append('exp_soli', document.getElementById('exp_soli').value);
        formData.append('tipo_licencia', document.getElementById('tipo_licencia').value);
        formData.append('pariente', document.getElementById('pariente').value);
        formData.append('nombre_pariente', document.getElementById('nombre_pariente').value);
    
        // Crea una solicitud AJAX para enviar los datos al script PHP
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'Views/Resources/php/enviarvacanteLaboral.php', true);
        
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
        <input data-form-name="vacanteLaboral" type="email" class="form-control" name="extraEmail[]" value="${email}" placeholder="Correo adicional" required>
        <div class="input-group-append">
        <button class="btn btn-secondary" data-form-name="vacanteLaboral" data-email="${email}" type="button" onclick="editEmail(this)">Editar</button>
        <button class="btn btn-danger" data-form-name="vacanteLaboral" data-email="${email}" type="button" onclick="removeEmailField(this)">Eliminar</button>
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

    if (formName !== 'vacanteLaboral') {
        alert('Este correo no se puede editar porque no pertenece a vacanteLaboral.');
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

    if (formName !== 'vacanteLaboral') {
        alert('Este correo no se puede eliminar porque no pertenece a vacanteLaboral.');
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