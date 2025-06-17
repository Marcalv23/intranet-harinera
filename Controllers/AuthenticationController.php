<?php
include '../Models/BLauthentication.php';
class AuthenticationController
{
    public static function login($email, $password)
    {
        $login = BLauthentication::BLlogin($email, $password);
        if ($login) {
            return true;
        } else {
            return false;
        }
    }

    public static function registerUser($nombre, $email, $password)
{
    // Llamar a la función que maneja el registro en la base de datos
    $result = BLauthentication::BLregisterUser($email, $nombre, $password);
    
    // Verificar el resultado de la función de registro
    if ($result === true) {
        // Registro exitoso, devolver mensaje de éxito
        return "¡Registro exitoso!";
    } else {
        // Si hubo un error en el registro, devolver el mensaje de error
        return $result;  // $result debe contener el mensaje de error de BLregisterUser
    }
}

}
