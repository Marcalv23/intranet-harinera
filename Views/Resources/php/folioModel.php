<?php
class FolioModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getLastFolio($tableName) {
        try {
            // Escapar el nombre de la tabla para evitar inyecciones SQL
            $tableName = preg_replace('/[^a-zA-Z0-9_]/', '', $tableName);
            $query = "SELECT MAX(folio) AS ultimo_folio FROM " . $tableName;
            
            error_log('Consulta SQL: ' . $query); // Log de la consulta SQL

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Si no hay folio, comenzar desde 49
            $ultimoFolio = $result['ultimo_folio'] ?? 49;

            // Depuración
            error_log('Último folio obtenido de la tabla ' . $tableName . ': ' . $ultimoFolio);

            return $ultimoFolio;
        } catch (PDOException $e) {
            // Depuración
            error_log('Error al obtener el folio de la tabla ' . $tableName . ': ' . $e->getMessage());
            throw new Exception('Error al obtener el folio: ' . $e->getMessage());
        }
    }
}
?>
