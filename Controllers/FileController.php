<?php

class FileController
{
    public static function subirArchivo($file, $idEmpleado)
    {
        // Llama al método BLsubirArchivo del modelo BLfiles pasando el archivo y el id del empleado
        if (BLfiles::BLsubirArchivo($file, $idEmpleado)) {
            return true;
        } else {
            return false;
        }
    }

    public static function eliminarArchivo($idArchivo)
    {
        // Llama al método BLeliminarArchivo del modelo BLfiles pasando el id del archivo
        if (BLfiles::BLeliminarArchivo($idArchivo)) {
            return true;
        } else {
            return false;
        }
    }

    public static function obtenerArchivosPorEmpleado($idEmpleado)
    {
        try {
            // Llama al método BLobtenerArchivosPorEmpleado del modelo BLfiles pasando el id del empleado
            $archivos = BLfiles::BLobtenerArchivosPorEmpleado($idEmpleado);
            return $archivos;
        } catch (PDOException $e) {
            // Manejo de errores específico para PDOException
            echo 'Error al obtener los archivos: ' . $e->getMessage();
            return []; // Retorna un array vacío en caso de error
        }
    }
}
?>

