#!/bin/bash
echo "🧪 Ejecutando pruebas en entorno CI..."

# Prueba 1: ¿Existe config.php?
if [ ! -f config.php ]; then
  echo "❌ config.php no encontrado"
  exit 1
fi

# Prueba 2: ¿Se puede conectar a la BD?
php -r "
require_once 'config.php';
try {
  \$pdo = new PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
  echo '✅ Conexión a BD exitosa\n';
} catch (Exception \$e) {
  echo '❌ Error: ' . \$e->getMessage() . '\n';
  exit(1);
}
"

# Prueba 3: ¿Carga la página principal?
if php -f index.php | grep -q "<title>"; then
  echo "✅ index.php se ejecuta correctamente"
else
  echo "❌ index.php falló o no generó HTML válido"
  exit 1
fi

echo "🎉 Todas las pruebas pasaron."
