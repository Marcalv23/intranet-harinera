#!/bin/bash
echo "🧪 Ejecutando pruebas en entorno CI..."

# Prueba 1: ¿Existe Models/Connection.php?
if [ ! -f Models/Connection.php ]; then
  echo "❌ Models/Connection.php no encontrado"
  exit 1
fi

# Prueba 2: Crear script temporal para probar conexión respetando Singleton
cat > test-db-connection.php <<'EOF'
<?php
require_once __DIR__ . '/Models/Connection.php';

try {
    // Intentar obtener la instancia (asumiendo patrón Singleton)
    if (!method_exists('Connection', 'getInstance') && 
        !method_exists('Connection', 'getConnection') &&
        !method_exists('Connection', 'connect')) {
        throw new Exception("No se encontró un método estático para obtener la conexión.");
    }

    // Probar métodos comunes
    if (method_exists('Connection', 'getInstance')) {
        $conn = Connection::getInstance();
    } elseif (method_exists('Connection', 'getConnection')) {
        $conn = Connection::getConnection();
    } elseif (method_exists('Connection', 'connect')) {
        $conn = Connection::connect();
    }

    // Obtener el objeto PDO (puede estar en $conn directamente o en un método)
    if ($conn instanceof PDO) {
        $pdo = $conn;
    } elseif (is_object($conn) && method_exists($conn, 'getPDO')) {
        $pdo = $conn->getPDO();
    } elseif (is_object($conn) && property_exists($conn, 'pdo')) {
        $pdo = $conn->pdo;
    } else {
        // Intentar usar $conn como PDO directamente (en algunos diseños)
        $pdo = $conn;
    }

    if (!$pdo instanceof PDO) {
        throw new Exception("No se pudo obtener un objeto PDO válido desde Connection.");
    }

    // Consulta de prueba
    $result = $pdo->query("SELECT 1 AS test");
    if ($result && $result->fetchColumn() == "1") {
        echo "✅ Conexión a la base de datos exitosa\n";
    } else {
        throw new Exception("La consulta de prueba falló.");
    }

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>
EOF

# Ejecutar prueba
if php test-db-connection.php; then
  echo "✅ Prueba de conexión pasada"
else
  echo "❌ Falló la prueba de conexión"
  rm -f test-db-connection.php
  exit 1
fi

rm -f test-db-connection.php
echo "🎉 Todas las pruebas relevantes pasaron."
