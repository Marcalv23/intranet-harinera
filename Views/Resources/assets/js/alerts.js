// Función para cerrar automáticamente el alert después de 5 segundos
    setTimeout(function() {
        var alertBlock = document.getElementById('alertBlock');
        alertBlock.style.opacity = 0; // Cambia la opacidad a 0 para iniciar la animación de desvanecimiento

        // Agrega un evento de transición para eliminar el alert después de la animación
        alertBlock.addEventListener('transitionend', function() {
            alertBlock.remove(); // Remueve el alert del DOM después de la animación
        });

    }, 3000); // 5000 milisegundos = 5 segundos