<?php
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Finalmente, destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio de sesión (o cualquier otra página)
header("Location: ../Views/login.php");
exit();
