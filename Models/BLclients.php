<?php
require_once "Connection.php";

class BLclients
{
    private static $conn;

    private static function getConnection()
    {
        if (!isset(self::$conn)) {
            self::$conn = Connection::connectionBD();
        }
        return self::$conn;
    }

    static public function getClientActive()
    {
        try {
            $conn = self::getConnection();

            $sql = "SELECT * FROM client WHERE estadoCuenta = 'Activo'";

            $stmt = $conn->prepare($sql);  // Prepara la consulta SQL
            $stmt->execute();  // Ejecuta la consulta

            $cliente = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Obtiene todos los resultados

            return $cliente;
        } catch (PDOException $e) {
            throw new Exception('Error en la consulta: ' . $e->getMessage());
        }
        // $conn = null;
    }

    static public function getClientInactive()
    {
        try {
            $conn = self::getConnection();

            $sql = "SELECT * FROM client WHERE estadoCuenta = 'Inactivo'";

            $stmt = $conn->prepare($sql);  // Prepara la consulta SQL
            $stmt->execute();  // Ejecuta la consulta

            $cliente = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Obtiene todos los resultados

            return $cliente;
        } catch (PDOException $e) {
            throw new Exception('Error en la consulta: ' . $e->getMessage());
        }
    }

    static public function BLgetClientAll()
    {
        try {
            $conn = self::getConnection();

            $sql = "SELECT c.*, con.telefono
                    FROM client as c
                    LEFT JOIN contactocliente as con ON c.idCliente = con.idCliente
                    WHERE con.idTipoContato = 1 OR con.idTipoContato IS NULL";

            $stmt = $conn->query($sql);
            $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $clientes;
        } catch (PDOException $e) {
            // Manejo de errores de PDO
            echo 'Error en la consulta: ' . $e->getMessage();
            return [];
        }
    }

    static public function BLgetClientbyId($idCliente)
    {
        try {
            $conn = self::getConnection();

            $sql = "SELECT c.*, t.tipoContacto
                    FROM contactocliente as c
                    LEFT JOIN tipocontactocliente as t ON c.idTipoContato = t.idTipoContacto
                    WHERE c.idCliente = :idCliente";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_STR);
            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultados;
        } catch (PDOException $e) {
            echo "Error al ejecutar la consulta: " . $e->getMessage();
            return [];
        }
    }

    static public function BLblockclient($idCliente)
    {
        try {
            $conn = self::getConnection();

            $sql = "UPDATE client SET estadoCuenta = 'Inactivo' WHERE idCliente = :idCliente";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Error en la consulta: ' . $e->getMessage());
        }
    }

    static public function BLunlockclient($idCliente)
    {
        try {
            $conn = self::getConnection();

            $sql = "UPDATE client SET estadoCuenta = 'Activo' WHERE idCliente = :idCliente";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Error en la consulta: ' . $e->getMessage());
        }
    }

    static public function BLdeleteclient($idCliente)
    {
        try {
            $conn = self::getConnection();

            $sql = "UPDATE client SET estadoCuenta = 'Eliminado' WHERE idCliente = :idCliente";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Error en la consulta: ' . $e->getMessage());
        }
    }
	
	static public function BLpostInsertClients($datos)
    {
        try {
            $conn = self::getConnection();

            $sql = "INSERT INTO client(nombreCliente, apellidoPaterno, apellidoMaterno, direccion, ciudad, estado, 
                    codigoPostal, pais, fechaRegistro, informacion, tipoCliente, preferencia, notas, fechaUltimaActividad, 
                    estadoCuenta, fechaNacimiento, foto)VALUES(:nombre, :apellidoPaterno, :apellidoMaterno, :direccion, :ciudad,
                    :estado, :codigoPostal, :pais, :fechaRegistro, :informacion, :tipoCliente, :preferencia, :notas, :fechaUltimaActividad,
                    :estadoCuenta, :fechaNacimiento, :foto)";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':nombre', $datos['nombre']);
            $stmt->bindParam(':apellidoPaterno', $datos['apellidoPaterno']);
            $stmt->bindParam(':apellidoMaterno', $datos['apellidoMaterno']);
            $stmt->bindParam(':direccion', $datos['direccion']);
            $stmt->bindParam(':ciudad', $datos['ciudad']);
            $stmt->bindParam(':estado', $datos['estado']);
            $stmt->bindParam(':codigoPostal', $datos['codigoPostal']);
            $stmt->bindParam(':pais', $datos['pais']);

            $stmt->bindParam(':fechaRegistro', $datos['fechaRegistro']);
            $stmt->bindParam(':informacion', $datos['informacion']);
            $stmt->bindParam(':tipoCliente', $datos['tipoCliente']);
            $stmt->bindParam(':preferencia', $datos['preferencia']);
            $stmt->bindParam(':notas', $datos['notas']);
            $stmt->bindParam(':fechaUltimaActividad', $datos['fechaUltimaActividad']);
            $stmt->bindParam(':estadoCuenta', $datos['estadoCuenta']);
            $stmt->bindParam(':fechaNacimiento', $datos['fechaNacimiento']);
            $stmt->bindParam(':foto', $datos['foto']);

            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Error al agregar Cliente ' . $e->getMessage());
        }
    }
	
	static public function BLpostUpdate($datos)
    {
        try {
            $conn = self::getConnection();

            $sql = "UPDATE client SET nombreCliente = :nombreCliente,  apellidoPaterno = :apellidoPaterno, apellidoMaterno = :apellidoMaterno, direccion = :direccion,
                    ciudad = :ciudad, estado = :estado, codigoPostal = :codigoPostal, pais = :pais, informacion = :informacion, tipoCliente = :tipoCliente,
                    preferencia = :preferencia, notas = :notas, fechaUltimaActividad = :fechaUltimaActividad, fechaNacimiento = :fechaNacimiento, foto = :foto WHERE idCliente = :idCliente";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':nombreCliente', $datos['nombreCliente']);
            $stmt->bindParam(':apellidoPaterno', $datos['apellidoPaterno']);
            $stmt->bindParam(':apellidoMaterno', $datos['apellidoMaterno']);
            $stmt->bindParam(':direccion', $datos['direccion']);
            $stmt->bindParam(':ciudad', $datos['ciudad']);
            $stmt->bindParam(':estado', $datos['estado']);
            $stmt->bindParam(':codigoPostal', $datos['codigoPostal']);
            $stmt->bindParam(':pais', $datos['pais']);
            $stmt->bindParam(':informacion', $datos['informacion']);
            $stmt->bindParam(':tipoCliente', $datos['tipoCliente']);
            $stmt->bindParam(':preferencia', $datos['preferencia']);
            $stmt->bindParam(':notas', $datos['notas']);
            $stmt->bindParam(':fechaUltimaActividad', $datos['fechaUltimaActividad']);
            $stmt->bindParam(':fechaNacimiento', $datos['fechaNacimiento']);
            $stmt->bindParam(':foto', $datos['foto']);
            $stmt->bindParam(':idCliente', $datos['idCliente']);

            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Error al actualizar Colaborador ' . $e->getMessage());
        }
    }
}

