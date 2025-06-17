<?php
// Configura la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "base4";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => "Error de conexión: " . $e->getMessage()]);
    exit;
}

$id = $_GET['id'];
$type = $_GET['type'];

// Define la consulta SQL según el tipo de tabla
switch ($type) {
    case 'reinci':
        $sql = "SELECT * FROM reinci WHERE id = :id";
        break;
    case 'solimercaservi':
        $sql = "SELECT s.*, m.partida, m.cantidad, m.unidad, m.descripcion
                FROM solimercaservi s
                LEFT JOIN mercancias_servicios m ON s.id = m.soliMercaServi_id
                WHERE s.id = :id";
        break;
    case 'postulaciones':
        $sql = "SELECT * FROM postulaciones WHERE id = :id";
        break;
    case 'esvisitantes':
        $sql = "SELECT e.*, c.tipoEquipo, c.marca, c.modelo, c.numeroSerie, c.perteneceHO
        FROM esvisitantes e
        LEFT JOIN esvisitantescaracteristicas c ON e.id = c.id
        WHERE e.id = :id";
        break;
    case 'escolaboradores':
        $sql = "SELECT e.*, d.nombre AS departamento, c.tipo_equipo, c.marca, c.modelo, c.numero_serie
        FROM escolaboradores e
        LEFT JOIN departamento d ON e.idDepartamento = d.idDepto
        LEFT JOIN caracteristicasescolaboradores c ON e.id = c.ESColaboradores_id
        WHERE e.id = :id";
        break;
    default:
        echo json_encode(["error" => "Tipo de tabla inválido"]);
        exit;
}

try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        echo json_encode($data);
    } else {
        echo json_encode(["error" => "No se encontraron datos"]);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Error en la consulta: " . $e->getMessage()]);
}
?>
