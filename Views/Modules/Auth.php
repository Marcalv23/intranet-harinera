<?php


if (!isset($_SESSION['user_id'])) {
    header("Location: Views/login.php");
    exit;
}

// Incluir la clase BLauthentication si no está incluida
require_once "Models/BLauthentication.php";

// Obtener el rol del usuario usando la función obtenerRolUsuario de BLauthentication
$user_id = $_SESSION['user_id'];
$user_rol = BLauthentication::obtenerRolUsuario($user_id);

if ($user_rol === 'error' || $user_rol === 'unknown') {
    // Manejar el error o caso desconocido del rol
    error_log('Error al obtener el rol del usuario');
} else {
    // Almacenar el rol del usuario en la sesión
    $_SESSION['user_rol'] = $user_rol;
}
?>
