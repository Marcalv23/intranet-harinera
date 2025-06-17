<?php
require_once "Connection.php";

// Habilitar el reporte de errores en desarrollo
ini_set('display_errors', 1);
error_reporting(E_ALL);

class BLauthentication
{
    public static function BLlogin($email, $password)
    {
        try {
            $conn = Connection::connectionBD(); // Obtener la conexión PDO
    
            // Consultar la información del usuario
            $sql = 'SELECT e.idEmpleado, e.emailEmpleado, e.hashed_password, r.nombre as rol_nombre,
                           e.nombreEmpleado, e.apellidoPaterno, e.apellidoMaterno, e.telefono, e.noEmpleado,
                           e.idDepartamento, e.estadoEmpleado
                    FROM empleado e
                    INNER JOIN rol r ON e.idRol = r.idRol
                    WHERE e.emailEmpleado = :email';
            $stmt = $conn->prepare($sql);
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user && password_verify($password, $user['hashed_password'])) {
                if ($user['estadoEmpleado'] === 'Activo') {
                    session_start();
                    session_regenerate_id(true);
                    $_SESSION['user_id'] = $user['idEmpleado'];
                    $_SESSION['email'] = $user['emailEmpleado'];
                    $_SESSION['user_rol'] = $user['rol_nombre']; // Almacenar el nombre del rol
                    $_SESSION['nombre'] = $user['nombreEmpleado']; 
                    $_SESSION['Ape_paterno'] = $user['apellidoPaterno'];
                    $_SESSION['Ape_materno'] = $user['apellidoMaterno'];
                    $_SESSION['telefono'] = $user['telefono'];
                    $_SESSION['N_colaborador'] = $user['noEmpleado'];
    
                    // Obtener el nombre del departamento desde la base de datos
                    $stmtDepto = $conn->prepare('SELECT nombre FROM departamento WHERE idDepto = :idDepartamento');
                    $stmtDepto->bindParam(':idDepartamento', $user['idDepartamento']);
                    $stmtDepto->execute();
                    $departamento = $stmtDepto->fetchColumn();
    
                    // Verificar si se encontró el departamento
                    if ($departamento === false) {
                        $_SESSION['departamento'] = 'Desconocido';
                    } else {
                        $_SESSION['departamento'] = $departamento;
                    }
    
                    return true;
                } else {
                    return "Tu cuenta está bloqueada. Por favor, contacta al administrador.";
                }
            } else {
                return "Email o contraseña incorrectos.";
            }
        } catch (PDOException $e) {
            error_log('Error en la consulta de login: ' . $e->getMessage());
            return "Error en el servidor. Por favor, intenta más tarde.";
        }
    }

    

    // Método para verificar si un email ya está registrado en la base de datos
    private static function emailExistsInDatabase($email)
    {
        try {
            $conn = Connection::connectionBD(); // Obtener la conexión PDO

            $sql = 'SELECT COUNT(*) AS count FROM empleado WHERE emailEmpleado = :email';
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                error_log('Error al preparar la consulta de verificación de correo.');
                return false;
            }
            $stmt->execute(['email' => $email]);
            $result = $stmt->fetch();

            return ($result['count'] > 0);
        } catch (PDOException $e) {
            error_log('Error en la consulta de verificación de correo electrónico: ' . $e->getMessage());
            return false;
        }
    }

    // Método para verificar la existencia del correo en la web
    private static function emailExistsOnWeb($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $domain = substr(strrchr($email, "@"), 1);

        $mxhosts = [];
        if (!checkdnsrr($domain, "MX")) {
            return false;
        }

        return true;
    }

    // Método para obtener el rol de un usuario
    public static function obtenerRolUsuario($idEmpleado)
    {
        try {
            $conn = Connection::connectionBD(); // Obtener la conexión PDO

            $sql = 'SELECT r.nombreRol 
                    FROM empleado e
                    INNER JOIN rol r ON e.idRol = r.idRol
                    WHERE e.idEmpleado = :idEmpleado';
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                error_log('Error al preparar la consulta para obtener el rol del usuario: ' . implode(', ', $stmt->errorInfo()));
                return 'error'; // Manejar errores de consulta
            }
            $stmt->execute(['idEmpleado' => $idEmpleado]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $result['nombreRol']; // Devolver el nombre del rol
            } else {
                return 'unknown'; // Manejar el caso donde no se encuentra el usuario o no tiene rol definido
            }
        } catch (PDOException $e) {
            error_log('Error al obtener el rol del usuario: ' . $e->getMessage());
            return 'error'; // Manejar errores de consulta
        }
    }

    // Método para registrar un usuario
// Método para registrar un usuario
public static function BLregisterUser($nombre, $email, $password)
{
    try {
        $conn = Connection::connectionBD(); // Obtener la conexión PDO

        if (!$conn) {
            error_log('Error de conexión a la base de datos.');
            return "Error en el servidor. Por favor, intenta más tarde.";
        }

        // Verificar si el correo electrónico ya está registrado
        $sql = 'SELECT COUNT(*) FROM empleado WHERE emailEmpleado = :email';
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            error_log('Error al preparar la consulta de verificación de correo.');
            return "Error en el servidor. Por favor, intenta más tarde.";
        }
        $stmt->execute(['email' => $email]);
        $existingUserCount = $stmt->fetchColumn();

        if ($existingUserCount > 0) {
            return "El correo electrónico ya está registrado.";
        }

        // Valores por defecto
        $defaultPhone = "000-000-0000";
        $defaultRole = 1;
        $defaultDepartmentId = 1;
        $status = 'Activo';
        $defaultApellido = 'Apellido1';
        $defaultApellido2 = 'Apellido2';

        // Cifrar la contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Generar número de empleado único
        $stmtNoEmpleado = $conn->query('SELECT MAX(noEmpleado) + 1 FROM empleado');
        $nextNoEmpleado = $stmtNoEmpleado->fetchColumn();
        if (!$nextNoEmpleado) {
            $nextNoEmpleado = 1; // Inicializar si es el primer registro
        }

        // Registrar nuevo usuario con `noEmpleado` y `hashed_password`
        $sqlInsert = 'INSERT INTO empleado (emailEmpleado, hashed_password, nombreEmpleado, apellidoPaterno, apellidoMaterno, telefono, idRol, idDepartamento, estadoEmpleado, noEmpleado) 
                      VALUES (:email, :hashed_password, :nombre, :apellidoPaterno, :apellidoMaterno, :telefono, :idRol, :idDepartamento, :estado, :noEmpleado)';
        
        $stmtInsert = $conn->prepare($sqlInsert);
        if (!$stmtInsert) {
            error_log('Error al preparar la consulta de inserción.');
            return "Error en el servidor. Por favor, intenta más tarde.";
        }
        
        // Ejecutar la consulta con los datos
        $stmtInsert->execute([
            'email' => $email,
            'hashed_password' => $hashedPassword,  // Guardar la contraseña cifrada en `hashed_password`
            'nombre' => $nombre,  
            'apellidoPaterno' => $defaultApellido,  
            'apellidoMaterno' => $defaultApellido2,
            'telefono' => $defaultPhone,
            'idRol' => $defaultRole,
            'idDepartamento' => $defaultDepartmentId,
            'estado' => $status,
            'noEmpleado' => $nextNoEmpleado  // Valor único para `noEmpleado`
        ]);

        return true; // Usuario registrado exitosamente
    } catch (PDOException $e) {
        error_log('Error al registrar al usuario: ' . $e->getMessage());
        return "Error en el servidor. Por favor, intenta más tarde.";
    }
}




}
