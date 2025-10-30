#!/bin/bash
echo "🧪 Ejecutando pruebas en entorno CI..."

if [ ! -f Models/Connection.php ]; then
  echo "❌ Models/Connection.php no encontrado"
  exit 1
fi

echo "✅ Models/Connection.php existe"

# Crear script de prueba con diagnóstico detallado
cat > test-db-connection.php <<'EOF'
<?php
echo "🔍 Intentando cargar Models/Connection.php...\n";

// Verificar que el archivo existe
if (!file_exists(__DIR__ . '/Models/Connection.php')) {
    die("❌ Archivo Models/Connection.php no encontrado en la ruta esperada.\n");
}

// Incluir el archivo
require_once __DIR__ . '/Models/Connection.php';

echo "✅ Archivo cargado. Verificando clase y método...\n";

// Verificar si la clase existe
if (!class_exists('Connection')) {
    die("❌ La clase 'Connection' no se definió después de incluir el archivo.\n");
}

// Verificar si el método estático existe
if (!method_exists('Connection', 'connectionBD')) {
    die("❌ El método estático 'connectionBD()' no existe en la clase Connection.\n");
}

echo "✅ Método connectionBD() encontrado. Probando conexión...\n";

try {
    $pdo = Connection::connectionBD();
    if (!$pdo instanceof PDO) {
        throw new Exception("No se obtuvo un objeto PDO.");
    }
    $result = $pdo->query("SELECT 1");
    if ($result && $result->fetchColumn() == "1") {
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

# Ejecutar
if php test-db-connection.php; then
  echo "✅ Prueba completada con éxito"
else
  echo "❌ La prueba falló"
  rm -f test-db-connection.php
  exit 1
fi

rm -f test-db-connection.php
