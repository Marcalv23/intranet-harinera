<?php

class Connection
{
    private static $conn = null;

    private function __construct()
    {
        // Constructor privado para evitar instanciación fuera de la clase
    }

    public static function connectionBD()
    {
        if (!self::$conn) {
            $host = 'localhost';
            $dbname = 'base4';
            $username = 'root';
            $password = '';

            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

            try {
                self::$conn = new PDO($dsn, $username, $password);
                // Configurar el manejo de errores de PDO
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // Manejar error de conexión como mejor convenga tu aplicación
                die('Error de conexión: ' . $e->getMessage());
            }
        }

        return self::$conn;
    }
}
