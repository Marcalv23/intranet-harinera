<?php
require '../../../Models/Connection.php';

class EmailManager {
    private $conn;

    public function __construct() {
        // Supongo que la conexión a la base de datos se inicializa aquí
        $this->conn = Connection::connectionBD();
    }

    // Método para insertar correos electrónicos
    public function insertEmails($emails, $formName) {
        $this->conn->beginTransaction(); // Iniciar transacción para manejar múltiples inserciones

        $queryCheck = "SELECT COUNT(*) FROM correosForms WHERE email = :email AND formName = :formName";
        $checkStmt = $this->conn->prepare($queryCheck);

        $queryInsert = "INSERT INTO correosForms (email, formName) VALUES (:email, :formName)";
        $insertStmt = $this->conn->prepare($queryInsert);

        foreach ($emails as $email) {
            $checkStmt->bindParam(':email', $email);
            $checkStmt->bindParam(':formName', $formName);
            $checkStmt->execute();
            $exists = $checkStmt->fetchColumn();

            if ($exists == 0) { // Solo insertar si no existe
                $insertStmt->bindParam(':email', $email);
                $insertStmt->bindParam(':formName', $formName);
                $insertStmt->execute();
            }
        }
        $this->conn->commit();
    }

    // Método para eliminar un correo electrónico
    public function deleteEmail($email, $formName) {
        $query = "DELETE FROM correosForms WHERE email = :email AND formName = :formName";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':formName', $formName);
        $stmt->execute();
    }
    

    // Método para actualizar un correo electrónico
    public function updateEmail($oldEmail, $newEmail, $formName) {
        $query = "UPDATE correosForms SET email = :new_email WHERE email = :old_email AND formName = :formName";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':new_email', $newEmail);
        $stmt->bindParam(':old_email', $oldEmail);
        $stmt->bindParam(':formName', $formName);
        $stmt->execute();
    }
    

    // Método para obtener todos los correos electrónicos
    public function getEmails($formName) {
        $sql = 'SELECT email FROM correosForms WHERE formName = :formName';
        $stmt = $this->conn->prepare($sql); // Cambiado de $this->pdo a $this->conn
        $stmt->bindParam(':formName', $formName, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
?>
