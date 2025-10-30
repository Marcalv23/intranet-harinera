#!/bin/bash
echo "🧪 Ejecutando pruebas en entorno CI..."

# Prueba 1: ¿Existe el archivo de conexión?
if [ ! -f Models/Connection.php ]; then
  echo "❌ Models/Connection.php no encontrado"
  exit 1
fi

# Prueba 2: Crear un script temporal para probar la conexión usando tu clase
cat > test-db-connection.php <<'EOF'
<?php
// Cargar la clase de conexión (ajusta la ruta si es necesario)
require_once __DIR__ . '/Models/Connection.php';

try {
    // Asumimos que Connection.php define una clase llamada Connection
    // y que tiene un método para obtener una instancia de PDO
    $db = new Connection(); // o Connection::getInstance(), según tu implementación

    // Si tu clase devuelve directamente un objeto PDO:
    if ($db instanceof PDO) {
        $pdo = $db;
    } elseif (method_exists($db, 'connect') || method_exists($db, 'getConnection')) {
        // Intentar métodos comunes
        $pdo = $db->connect() ?? $db->getConnection();
    } else {
        throw new Exception("La clase Connection no expone un objeto PDO válido.");
    }

    if (!$pdo instanceof PDO) {
        throw new Exception("El método de conexión no devolvió un objeto PDO.");
    }

    // Hacer una consulta simple para verificar que funciona
    $stmt = $pdo->query("SELECT 1");
    if ($stmt && $stmt->fetchColumn() === "1") {
        echo "✅ Conexión a la base de datos exitosa\n";
    } else {
        throw new Exception("Consulta de prueba fallida.");
    }

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>
EOF

# Ejecutar la prueba de conexión
if php test-db-connection.php; then
  echo "✅ Prueba de conexión pasada"
else
  echo "❌ Falló la prueba de conexión"
  rm -f test-db-connection.php
  exit 1
fi

# Limpiar archivo temporal
rm -
