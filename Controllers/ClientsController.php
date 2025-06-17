<?php

class ClientsController
{
    static public function getUsersActive()
    {
        try {
            $clienteActivos = BLclients::getClientActive();  // Llama al método de la capa de negocios

            return $clienteActivos;  // Retorna los empleados activos obtenidos
        } catch (PDOException $e) {
            // Manejo de errores
            echo 'Error al obtener clientes activos: ' . $e->getMessage();
        }
    }

    static public function getUsersInactive()
    {
        try {
            $clienteInactivos = BLclients::getClientInactive();  // Llama al método de la capa de negocios

            return $clienteInactivos;  // Retorna los empleados activos obtenidos
        } catch (PDOException $e) {
            // Manejo de errores
            echo 'Error al obtener clientes Bloqueados: ' . $e->getMessage();
        }
    }

    static public function getClientAll()
    {

        $clientes = BLclients::BLgetClientAll();  // Llama al método de la capa de negocios

        return $clientes;  // Retorna los empleados activos obtenidos

    }

    static public function getClientbyId($idCliente)
    {

        $cliente = BLclients::BLgetClientbyId($idCliente);  // Llama al método de la capa de negocios

        return $cliente;  // Retorna los empleados activos obtenidos

    }

    static public function blockclient($idCliente)
    {
        try {
            BLclients::BLblockclient($idCliente);
        } catch (Exception $e) {
            // Manejo de errores: Puedes redirigir a una página de error o mostrar un mensaje
            echo 'Error al bloquear cliente: ' . $e->getMessage();
        }
    }

    static public function unlockclient($idCliente)
    {
        try {
            BLclients::BLunlockclient($idCliente);
        } catch (Exception $e) {
            // Manejo de errores: Puedes redirigir a una página de error o mostrar un mensaje
            echo 'Error al desbloquear cliente: ' . $e->getMessage();
        }
    }

    static public function deleteclient($idCliente)
    {
        try {
            BLclients::BLdeleteclient($idCliente);
        } catch (Exception $e) {
            // Manejo de errores: Puedes redirigir a una página de error o mostrar un mensaje
            echo 'Error al eliminar cliente: ' . $e->getMessage();
        }
    }
	
	static public function postInsertClientes()
    {
        if (isset($_POST['registrar'])) {
            $datos = [
                'nombre' => $_POST['nombre'],
                'apellidoPaterno' => $_POST['apellidoPaterno'],
                'apellidoMaterno' => $_POST['apellidoMaterno'],
                'direccion' => $_POST['direccion'],
                'ciudad' => $_POST['ciudad'],
                'estado' => $_POST['estado'],
                'codigoPostal' => $_POST['codigoPostal'],
                'pais' => $_POST['pais'],
                'fechaRegistro' => $_POST['fechaRegistro'],
                'informacion' => $_POST['informacion'],
                'tipoCliente' => $_POST['tipoCliente'],
                'preferencia' => $_POST['preferencia'],
                'notas' => $_POST['notas'],
                'fechaUltimaActividad' => $_POST['fechaUltimaActividad'],
                'estadoCuenta' => $_POST['estadoCuenta'],
                'fechaNacimiento' => $_POST['fechaNacimiento'],
                'foto' => $_POST['foto'],
            ];
            try {
                // Llamar a la función del modelo para insertar en la base de datos
                BLclients::BLpostInsertClients($datos);
                // Redirigir o mostrar un mensaje de éxito
                echo '<script>window.location.href = "Clientes";</script>';
                exit;
            } catch (Exception $e) {
                // Manejar el error, mostrar un mensaje al usuario, registrar el error, etc.
                echo "Error: " . $e->getMessage();
            }
        }
    }
	
	static public function postUpdateClient()
    {
        if (isset($_POST['actualizar'])) {
            $datos = [
                'idCliente' => $_POST['idCliente'],
                'nombreCliente' => $_POST['nombreCliente'],
                'apellidoPaterno' => $_POST['apellidoPaterno'],
                'apellidoMaterno' => $_POST['apellidoMaterno'],
                'direccion' => $_POST['direccion'],
                'ciudad' => $_POST['ciudad'],
                'estado' => $_POST['estado'],
                'codigoPostal' => $_POST['codigoPostal'],
                'pais' => $_POST['pais'],
                'informacion' => $_POST['informacion'],
                'tipoCliente' => $_POST['tipoCliente'],
                'preferencia' => $_POST['preferencia'],
                'notas' => $_POST['notas'],
                'fechaUltimaActividad' => $_POST['fechaUltimaActividad'],
                'fechaNacimiento' => $_POST['fechaNacimiento'],
                'foto' => $_POST['foto'],
            ];
            try {
                // Llamar a la función del modelo para actualizar los datos
                BLclients::BLpostUpdate($datos);
                // Redirigir o mostrar un mensaje de éxito
                echo '<script>window.location.href = "Clientes";</script>';
                exit;
            } catch (Exception $e) {
                // Manejar el error, mostrar un mensaje al usuario, registrar el error, etc.
                echo "Error: " . $e->getMessage();
            }
        }
    }
}

