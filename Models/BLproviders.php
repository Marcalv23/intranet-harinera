<?php
require_once "Connection.php";

class BLproviders
{
    private static $conn;

    private static function getConnection()
    {
        if (!isset(self::$conn)) {
            self::$conn = Connection::connectionBD();
        }
        return self::$conn;
    }

    static public function getProvidersActive()
    {
        try {
            $conn = self::getConnection();

            $sql = "SELECT * FROM proveedores WHERE estadoProveedor = 'Activo'";

            $stmt = $conn->prepare($sql);  // Prepara la consulta SQL
            $stmt->execute();  // Ejecuta la consulta

            $proveedores = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Obtiene todos los resultados

            return $proveedores;
        } catch (PDOException $e) {
            throw new Exception('Error en la consulta: ' . $e->getMessage());
        }
    }

    static public function getProvidersInactive()
    {
        try {
            $conn = self::getConnection();

            $sql = "SELECT * FROM proveedores WHERE estadoProveedor = 'Inactivo'";

            $stmt = $conn->prepare($sql);
            $stmt->execute(); 

            $proveedores = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $proveedores;
        } catch (PDOException $e) {
            throw new Exception('Error en la consulta: ' . $e->getMessage());
        }
    }

    static public function BLgetProvidersAll()
    {
        try {
            $conn = self::getConnection();

            $sql = "SELECT p.*,c.telefono, c.email
                    FROM proveedores as p
                    LEFT JOIN contactoproveedor as c ON p.idProveedor = c.idProveedor
                    WHERE c.idTipoContacto = 1 OR c.idTipoContacto IS NULL";

            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $proveedores = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $proveedores;
        } catch (PDOException $e) {
            throw new Exception('Error en la consulta: ' . $e->getMessage());
        }
    }

    static public function BLgetProvidersbyId($idProveedor)
    {
        try {
            $conn = self::getConnection();

            $sql = "SELECT c.*, t.tipoContacto
                    FROM contactoproveedor as c
                    LEFT JOIN tipocontacto as t ON c.idTipoContacto = t.idTipoContacto
                    WHERE c.idProveedor = :idProveedor";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':idProveedor', $idProveedor, PDO::PARAM_STR);
            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultados;
        } catch (PDOException $e) {
            echo "Error al ejecutar la consulta: " . $e->getMessage();
            return [];
        }
    }

    static public function BLblockprovider($idProveedor)
    {
        try {
            $conn = self::getConnection();

            $sql = "UPDATE proveedores SET estadoProveedor = 'Inactivo' WHERE idProveedor = :idProveedor";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':idProveedor', $idProveedor, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Error en la consulta: ' . $e->getMessage());
        }
    }

    static public function BLunlockprovider($idProveedor)
    {
        try {
            $conn = self::getConnection();

            $sql = "UPDATE proveedores SET estadoProveedor = 'Activo' WHERE idProveedor = :idProveedor";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':idProveedor', $idProveedor, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Error en la consulta: ' . $e->getMessage());
        }
    }

    static public function BLdeleteprovider($idProveedor)
    {
        try {
            $conn = self::getConnection();

            $sql = "UPDATE proveedores SET estadoProveedor = 'Eliminado' WHERE idProveedor = :idProveedor";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':idProveedor', $idProveedor, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Error en la consulta: ' . $e->getMessage());
        }
    }
	
	static public function BLpostInsertProviders($datos)
    {
        try {
            $conn = self::getConnection();

            $sql = "INSERT INTO proveedores(nombreEmpresa, direccionProveedor, ciudad, estado, codigoPostal, pais, fechaRegistro, informacionProveedor, logo,
                    tipoProveedor, notas, fechaUltimaActividad, estadoProveedor, sitioWeb, rfc, tipoBanco, cuentaBancaria)
                    VALUES(:nombreEmpresa, :direccionProveedor, :ciudad, :estado, :codigoPostal, :pais, :fechaRegistro, :informacionProveedor, :logo,
                    :tipoProveedor, :notas, :fechaUltimaActividad, :estadoProveedor, :sitioWeb, :rfc, :tipoBanco, :cuentaBancaria);";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':nombreEmpresa', $datos['nombreEmpresa']);
            $stmt->bindParam(':direccionProveedor', $datos['direccionProveedor']);
            $stmt->bindParam(':ciudad', $datos['ciudad']);
            $stmt->bindParam(':estado', $datos['estado']);
            $stmt->bindParam(':codigoPostal', $datos['codigoPostal']);
            $stmt->bindParam(':pais', $datos['pais']);

            $stmt->bindParam(':fechaRegistro', $datos['fechaRegistro']);
            $stmt->bindParam(':informacionProveedor', $datos['informacionProveedor']);
            $stmt->bindParam(':logo', $datos['logo']);
            $stmt->bindParam(':tipoProveedor', $datos['tipoProveedor']);
            $stmt->bindParam(':notas', $datos['notas']);
            $stmt->bindParam(':fechaUltimaActividad', $datos['fechaUltimaActividad']);
            $stmt->bindParam(':estadoProveedor', $datos['estadoProveedor']);
            $stmt->bindParam(':sitioWeb', $datos['sitioWeb']);
            $stmt->bindParam(':rfc', $datos['rfc']);
            $stmt->bindParam(':tipoBanco', $datos['tipoBanco']);
            $stmt->bindParam(':cuentaBancaria', $datos['cuentaBancaria']);

            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Error al agregar Proveedor ' . $e->getMessage());
        }
    }
	
	static public function BLpostUpdate($datos)
    {
        try {
            $conn = self::getConnection();

            $sql = "UPDATE proveedores SET nombreEmpresa = :nombreEmpresa, direccionProveedor = :direccionProveedor, ciudad = :ciudad, estado = :estado,
                    codigoPostal = :codigoPostal, pais = :pais, informacionProveedor = :informacionProveedor, logo = :logo, 
                    tipoProveedor = :tipoProveedor, notas = :notas, fechaUltimaActividad = :fechaUltimaActividad, sitioWeb = :sitioWeb, rfc = :rfc, 
                    tipoBanco = :tipoBanco, cuentaBancaria = :cuentaBancaria WHERE idProveedor = :idProveedor;";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':nombreEmpresa', $datos['nombreEmpresa']);
            $stmt->bindParam(':direccionProveedor', $datos['direccionProveedor']);
            $stmt->bindParam(':ciudad', $datos['ciudad']);
            $stmt->bindParam(':estado', $datos['estado']);
            $stmt->bindParam(':codigoPostal', $datos['codigoPostal']);
            $stmt->bindParam(':pais', $datos['pais']);
            $stmt->bindParam(':informacionProveedor', $datos['informacionProveedor']);
            $stmt->bindParam(':logo', $datos['logo']);
            $stmt->bindParam(':tipoProveedor', $datos['tipoProveedor']);
            $stmt->bindParam(':notas', $datos['notas']);
            $stmt->bindParam(':fechaUltimaActividad', $datos['fechaUltimaActividad']);
            $stmt->bindParam(':sitioWeb', $datos['sitioWeb']);
            $stmt->bindParam(':rfc', $datos['rfc']);
            $stmt->bindParam(':tipoBanco', $datos['tipoBanco']);
            $stmt->bindParam(':cuentaBancaria', $datos['cuentaBancaria']);
            $stmt->bindParam(':idProveedor', $datos['idProveedor']);

            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Error al actualizar Colaborador ' . $e->getMessage());
        }
    }
}
