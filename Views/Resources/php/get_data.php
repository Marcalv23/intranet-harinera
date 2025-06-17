<?php
// Configura la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "base4";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtén el tipo de consulta desde la URL
    $type = isset($_GET['type']) ? $_GET['type'] : '';

    // Define la consulta SQL según el tipo de tabla
    switch ($type) {
        case 'reinci':
            $sql = "SELECT 
                    e.id, 
                    e.noEmpleado, 
                    d.nombre AS nombreDepartamento, 
                    e.nombreEmpleado, 
                    e.emailEmpleado, 
                    e.telefono 
                    FROM reinci e
                    JOIN departamento d ON e.idDepartamento = d.idDepto";
            break;
        case 'solimercaservi':
            $sql = "SELECT id, noEmpleado, idDepartamento, nombreEmpleado, apellidoPaterno, apellidoMaterno, emailEmpleado FROM solimercaservi";
            break;
        case 'postulaciones':
            $sql = "SELECT id, nombre, apellido, edad, correo, telefono FROM postulaciones";
            break;
        case 'esvisitantes':
            $sql = "SELECT id, nombreEmpresa, fechaSolicitud, nombreVisitante, correo, telefono FROM esvisitantes";
            break;
        case 'escolaboradores':
            $sql = "SELECT 
                    e.id, 
                    e.noEmpleado, 
                    d.nombre AS nombreDepartamento, 
                    e.nombreEmpleado, 
                    e.emailEmpleado, 
                    e.telefono 
                FROM escolaboradores e
                JOIN departamento d ON e.idDepartamento = d.idDepto
                LIMIT 0, 25";
            break;
        default:
            echo json_encode([]);
            exit;
    }

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
