<?php
require_once "Connection.php";

class BLemployee
{
    private static $conn;

    private static function getConnection()
    {
        if (!isset(self::$conn)) {
            self::$conn = Connection::connectionBD();
        }
        return self::$conn;
    }

    static public function getEmployeeActive()
    {
        try {
            $conn = self::getConnection();  // Obtiene la conexión a la base de datos

            $sql = "SELECT e.*, r.nombre as rol, d.nombre
                    FROM empleado as e
                    INNER JOIN rol as r ON e.idRol = r.idRol
                    INNER JOIN departamento as d ON e.idDepartamento = d.idDepto
                    WHERE estadoEmpleado = 'Activo';";

            $stmt = $conn->prepare($sql);  // Prepara la consulta SQL
            $stmt->execute();  // Ejecuta la consulta

            $empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Obtiene todos los resultados

            return $empleados;
        } catch (PDOException $e) {
            throw new Exception('Error en la consulta: ' . $e->getMessage());
        }
    }

    static public function getEmployeeInactive()
    {
        try {
            $conn = self::getConnection(); // Obtiene la conexión a la base de datos

            $sql = "SELECT e.*, r.nombre as rol, d.nombre
                    FROM empleado as e
                    INNER JOIN rol as r ON e.idRol = r.idRol
                    INNER JOIN departamento as d ON e.idDepartamento = d.idDepto
                    WHERE estadoEmpleado = 'Inactivo';";

            $stmt = $conn->prepare($sql);  // Prepara la consulta SQL
            $stmt->execute();  // Ejecuta la consulta

            $empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Obtiene todos los resultados

            return $empleados;
        } catch (PDOException $e) {
            throw new Exception('Error en la consulta: ' . $e->getMessage());
        }
    }

    static public function getEmployeebyId($noEmpleado)
    {
        try {
            $conn = self::getConnection();

            $sql = "SELECT e.*, r.nombre as rol, d.nombre
                    FROM empleado as e 
                    INNER JOIN rol as r ON e.idRol = r.idRol 
                    INNER JOIN departamento as d ON e.idDepartamento = d.idDepto 
                    WHERE e.noEmpleado = :noEmpleado";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':noEmpleado', $noEmpleado, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error en la consulta: ' . $e->getMessage());
            return null;
        }
    }

    static public function BLgetEmployeeAll()
    {
        try {
            $conn = self::getConnection();

            $sql = "SELECT e.*, r.nombre as rol, d.nombre
                    FROM empleado as e 
                    INNER JOIN rol as r ON e.idRol = r.idRol 
                    INNER JOIN departamento as d ON e.idDepartamento = d.idDepto";

            $stmt = $conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error en la consulta: ' . $e->getMessage());
        }
    }

    static public function BLblockemployee($idEmpleado)
    {
        try {
            $conn = self::getConnection();

            $sql = "UPDATE empleado set estadoEmpleado = 'Inactivo' where idEmpleado = :idEmpleado;";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':idEmpleado', $idEmpleado, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Error en la consulta: ' . $e->getMessage());
        }
    }

    static public function BLunlockemployee($idEmpleado)
    {
        try {
            $conn = self::getConnection();

            $sql = "UPDATE empleado set estadoEmpleado = 'Activo' where idEmpleado = :idEmpleado;";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':idEmpleado', $idEmpleado, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Error en la consulta: ' . $e->getMessage());
        }
    }

    static public function BLdeleteEmployee($idEmpleado)
    {
        try {
            $conn = self::getConnection();

            $sql = "UPDATE empleado set estadoEmpleado = 'Eliminado' where idEmpleado = :idEmpleado;";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':idEmpleado', $idEmpleado, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Error en la consulta: ' . $e->getMessage());
        }
    }
	
	 static public function BLgetRoles()
    {
        try {
            $conn = self::getConnection();

            $sql = "SELECT idRol ,nombre FROM rol";

            $stmt = $conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error en la consulta: ' . $e->getMessage());
        }
    }

    static public function BLgetdepartamento()
    {
        try {
            $conn = self::getConnection();

            $sql = "SELECT idDepto ,nombre FROM departamento";

            $stmt = $conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error en la consulta: ' . $e->getMessage());
        }
    }
	
	static public function BLpostInsert($datos)
    {
        try {
            $conn = self::getConnection();

            $sql = "INSERT INTO empleado(nombreEmpleado, apellidoPaterno, apellidoMaterno, fechaNacimiento, genero, emailEmpleado, hashed_password, telefono,
            direccion, ciudad, estado, codigoPostal, pais, fechaContratacion, salario, noEmpleado, estadoEmpleado, notas, numeroSeguroSocial, rfc, idDepartamento, idRol)
            VALUES(:nombreEmpleado, :apellidoPaterno,:apellidoMaterno, :fechaNacimiento, :genero, :emailEmpleado, :hashed_password, :telefono, :direccion,
            :ciudad, :estado, :codigoPostal, :pais, :fechaContratacion, :salario, :noEmpleado, :estadoEmpleado, :notas, :numeroSeguroSocial, :rfc, :idDepartamento, :idRol);";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':nombreEmpleado', $datos['nombreEmpleado']);
            $stmt->bindParam(':apellidoPaterno', $datos['apellidoPaterno']);
            $stmt->bindParam(':apellidoMaterno', $datos['apellidoMaterno']);
            $stmt->bindParam(':fechaNacimiento', $datos['fechaNacimiento']);
            $stmt->bindParam(':genero', $datos['genero']);
            $stmt->bindParam(':emailEmpleado', $datos['emailEmpleado']);

            $hashed_password = password_hash($datos['hashed_password'], PASSWORD_DEFAULT);
            $stmt->bindParam(':hashed_password', $hashed_password);
            $stmt->bindParam(':telefono', $datos['telefono']);
            $stmt->bindParam(':direccion', $datos['direccion']);
            $stmt->bindParam(':ciudad', $datos['ciudad']);
            $stmt->bindParam(':estado', $datos['estado']);
            $stmt->bindParam(':codigoPostal', $datos['codigoPostal']);
            $stmt->bindParam(':pais', $datos['pais']);
            $stmt->bindParam(':fechaContratacion', $datos['fechaContratacion']);
            $stmt->bindParam(':salario', $datos['salario']);
            $stmt->bindParam(':noEmpleado', $datos['noEmpleado']);
            $stmt->bindParam(':estadoEmpleado', $datos['estadoEmpleado']);
            $stmt->bindParam(':notas', $datos['notas']);
            $stmt->bindParam(':numeroSeguroSocial', $datos['numeroSeguroSocial']);
            $stmt->bindParam(':rfc', $datos['rfc']);
            $stmt->bindParam(':idDepartamento', $datos['idDepartamento']);
            $stmt->bindParam(':idRol', $datos['idRol']);

            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Error al agregar Colaborador ' . $e->getMessage());
        }
    }
	
	 static public function BLpostUpdate($datos)
    {
        try {
            $conn = self::getConnection();

            $sql = "UPDATE empleado SET nombreEmpleado = :nombreEmpleado, apellidoPaterno = :apellidoPaterno, apellidoMaterno = :apellidoMaterno, fechaNacimiento = :fechaNacimiento, 
        genero = :genero, emailEmpleado = :emailEmpleado, hashed_password = :hashed_password, telefono = :telefono, direccion = :direccion, ciudad = :ciudad, estado = :estado, 
        codigoPostal = :codigoPostal, pais = :pais, fechaContratacion = :fechaContratacion, salario = :salario, noEmpleado = :noEmpleado, notas = :notas, 
        numeroSeguroSocial = :numeroSeguroSocial, rfc = :rfc, idDepartamento = :idDepartamento, idRol = :idRol WHERE idEmpleado = :idEmpleado";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':nombreEmpleado', $datos['nombreEmpleado']);
            $stmt->bindParam(':apellidoPaterno', $datos['apellidoPaterno']);
            $stmt->bindParam(':apellidoMaterno', $datos['apellidoMaterno']);
            $stmt->bindParam(':fechaNacimiento', $datos['fechaNacimiento']);
            $stmt->bindParam(':genero', $datos['genero']);
            $stmt->bindParam(':emailEmpleado', $datos['emailEmpleado']);

            $hashed_password = password_hash($datos['hashed_password'], PASSWORD_DEFAULT);
            $stmt->bindParam(':hashed_password', $hashed_password);
            $stmt->bindParam(':telefono', $datos['telefono']);
            $stmt->bindParam(':direccion', $datos['direccion']);
            $stmt->bindParam(':ciudad', $datos['ciudad']);
            $stmt->bindParam(':estado', $datos['estado']);
            $stmt->bindParam(':codigoPostal', $datos['codigoPostal']);
            $stmt->bindParam(':pais', $datos['pais']);
            $stmt->bindParam(':fechaContratacion', $datos['fechaContratacion']);
            $stmt->bindParam(':salario', $datos['salario']);
            $stmt->bindParam(':noEmpleado', $datos['noEmpleado']);
            $stmt->bindParam(':notas', $datos['notas']);
            $stmt->bindParam(':numeroSeguroSocial', $datos['numeroSeguroSocial']);
            $stmt->bindParam(':rfc', $datos['rfc']);
            $stmt->bindParam(':idDepartamento', $datos['idDepartamento']);
            $stmt->bindParam(':idRol', $datos['idRol']);
            $stmt->bindParam(':idEmpleado', $datos['idEmpleado']);

            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Error al actualizar Colaborador ' . $e->getMessage());
        }
    }
}
