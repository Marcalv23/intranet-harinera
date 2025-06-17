<?php
class FormResponse {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getPostulaciones() {
        $sql = "SELECT puesto_postula, nombre, apellido, edad, sexo FROM postulaciones";
        return $this->conn->query($sql);
    }

    public function getProveedores() {
        $sql = "SELECT noEmpleado, nombreEmpleado, apellidoPaterno, apellidoMaterno, emailEmpleado FROM reinci";
        return $this->conn->query($sql);
    }

    public function getClientes() {
        $sql = "SELECT id, nombre, apellido, email, telefono FROM clientes";
        return $this->conn->query($sql);
    }
}
?>
