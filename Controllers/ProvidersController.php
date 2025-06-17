<?php

class ProvidersController
{
    static public function getUsersActive()
    {
        try {
            $proveedoresActivos = BLproviders::getProvidersActive();  // Llama al método de la capa de negocios

            return $proveedoresActivos;  // Retorna los empleados activos obtenidos
        } catch (PDOException $e) {
            // Manejo de errores
            echo 'Error al obtener proveedores activos: ' . $e->getMessage();
        }
    }

    static public function getUsersInactive()
    {
        try {
            $proveedoresInactivos = BLproviders::getProvidersInactive();  // Llama al método de la capa de negocios

            return $proveedoresInactivos;  // Retorna los empleados activos obtenidos
        } catch (PDOException $e) {
            // Manejo de errores
            echo 'Error al obtener proveedores Bloqueados: ' . $e->getMessage();
        }
    }

    static public function getProvidersAll()
    {
        try {
            $proveedores = BLproviders::BLgetProvidersAll();

            return $proveedores;
        } catch (PDOException $e) {
            echo 'Error al obtener proveedores: ' . $e->getMessage();
        }
    }

    static public function getProvidersbyId($idProveedor)
    {
        try {
            $proveedor = BLproviders::BLgetProvidersbyId($idProveedor);
            // Puedes devolver los resultados para ser utilizados en una vista
            return $proveedor;
        } catch (PDOException $e) {
            echo 'Error al obtener proveedores: ' . $e->getMessage();
        }
    }

    static public function blockprovider($idProveedor)
    {
        try {
            BLproviders::BLblockprovider($idProveedor);
        } catch (Exception $e) {
            // Manejo de errores: Puedes redirigir a una página de error o mostrar un mensaje
            echo 'Error al bloquear proveedor: ' . $e->getMessage();
        }
    }

    static public function unlockprovider($idProveedor)
    {
        try {
            BLproviders::BLunlockprovider($idProveedor);
        } catch (Exception $e) {
            // Manejo de errores: Puedes redirigir a una página de error o mostrar un mensaje
            echo 'Error al desbloquear proveedor: ' . $e->getMessage();
        }
    }

    static public function deleteprovider($idProveedor)
    {
        try {
            BLproviders::BLdeleteprovider($idProveedor);
        } catch (Exception $e) {
            // Manejo de errores: Puedes redirigir a una página de error o mostrar un mensaje
            echo 'Error al eliminar proveedor: ' . $e->getMessage();
        }
    }
	
	static public function postInsertProveedores()
    {
        if (isset($_POST['registrar'])) {
            $datos = [
                'nombreEmpresa' => $_POST['nombreEmpresa'],
                'direccionProveedor' => $_POST['direccionProveedor'],
                'ciudad' => $_POST['ciudad'],
                'estado' => $_POST['estado'],
                'codigoPostal' => $_POST['codigoPostal'],
                'pais' => $_POST['pais'],
                'fechaRegistro' => $_POST['fechaRegistro'],
                'informacionProveedor' => $_POST['informacionProveedor'],
                'logo' => $_POST['logo'],
                'tipoProveedor' => $_POST['tipoProveedor'],
                'notas' => $_POST['notas'],
                'fechaUltimaActividad' => $_POST['fechaUltimaActividad'],
                'estadoProveedor' => $_POST['estadoProveedor'],
                'sitioWeb' => $_POST['sitioWeb'],
                'rfc' => $_POST['rfc'],
                'tipoBanco' => $_POST['tipoBanco'],
                'cuentaBancaria' => $_POST['cuentaBancaria'],
            ];
            try {
                // Llamar a la función del modelo para insertar en la base de datos
                BLproviders::BLpostInsertProviders($datos);
                // Redirigir o mostrar un mensaje de éxito
                echo '<script>window.location.href = "Proveedores";</script>';
                exit;
            } catch (Exception $e) {
                // Manejar el error, mostrar un mensaje al usuario, registrar el error, etc.
                echo "Error: " . $e->getMessage();
            }
        }
    }
	
	 static public function postUpdateProveedores()
    {
        if (isset($_POST['actualizar'])) {
            $datos = [
                'idProveedor' => $_POST['idProveedor'],
                'nombreEmpresa' => $_POST['nombreEmpresa'],
                'direccionProveedor' => $_POST['direccionProveedor'],
                'ciudad' => $_POST['ciudad'],
                'estado' => $_POST['estado'],
                'codigoPostal' => $_POST['codigoPostal'],
                'pais' => $_POST['pais'],
                'informacionProveedor' => $_POST['informacionProveedor'],
                'logo' => $_POST['logo'],
                'tipoProveedor' => $_POST['tipoProveedor'],
                'notas' => $_POST['notas'],
                'fechaUltimaActividad' => $_POST['fechaUltimaActividad'],
                'estadoProveedor' => $_POST['estadoProveedor'],
                'sitioWeb' => $_POST['sitioWeb'],
                'rfc' => $_POST['rfc'],
                'tipoBanco' => $_POST['tipoBanco'],
                'cuentaBancaria' => $_POST['cuentaBancaria'],
            ];
            try {
                // Llamar a la función del modelo para insertar en la base de datos
                BLproviders::BLpostUpdate($datos);
                // Redirigir o mostrar un mensaje de éxito
                echo '<script>window.location.href = "Proveedores";</script>';
                exit;
            } catch (Exception $e) {
                // Manejar el error, mostrar un mensaje al usuario, registrar el error, etc.
                echo "Error: " . $e->getMessage();
            }
        }
    }
}

