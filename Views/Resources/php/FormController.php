<?php
// controllers/FormController.php

require 'Models/Connection.php'; // Asegúrate de que la ruta sea correcta

class FormController {
    public static function getResponses() {
        try {
            // Obtiene la conexión a la base de datos desde la clase Connection
            $pdo = Connection::connectionBD();

            // Consulta para obtener las respuestas del formulario
            $stmt = $pdo->query('SELECT puesto_postula, nombre, apellido, edad, sexo, correo FROM postulaciones');
            
            // Retornar resultados como un array asociativo
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejo de errores
            throw new Exception('Error en la consulta: ' . $e->getMessage());
        }
    }
}
?>
