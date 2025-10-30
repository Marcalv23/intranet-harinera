#!/bin/bash
# scripts/setup-release-env.sh

echo "🔧 Configurando entorno de liberación..."

# Rutas (ajusta según tu servidor)
RELEASE_DIR="/var/www/intranet-release"
DB_NAME="intranet_harinera_release"
DB_USER="intranet_user"
DB_PASS="secure_password_123"

# 1. Copiar código fuente
rm -rf $RELEASE_DIR
mkdir -p $RELEASE_DIR
cp -r ./* $RELEASE_DIR/

# 2. Instalar dependencias Composer (si no están)
cd $RELEASE_DIR
composer install --no-dev --optimize-autoloader

# 3. Crear base de datos limpia
mysql -u root -p"tu_root_password" -e "DROP DATABASE IF EXISTS $DB_NAME;"
mysql -u root -p"tu_root_password" -e "CREATE DATABASE $DB_NAME CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -u root -p"tu_root_password" -e "CREATE USER IF NOT EXISTS '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASS';"
mysql -u root -p"tu_root_password" -e "GRANT ALL PRIVILEGES ON $DB_NAME.* TO '$DB_USER'@'localhost';"
mysql -u root -p"tu_root_password" -e "FLUSH PRIVILEGES;"

# 4. Cargar esquema desde base4.sql
mysql -u $DB_USER -p$DB_PASS $DB_NAME < base4.sql

# 5. Crear archivo de configuración para el entorno de release
cat > $RELEASE_DIR/config.php <<EOF
<?php
// Configuración para entorno de release
define('DB_HOST', 'localhost');
define('DB_NAME', '$DB_NAME');
define('DB_USER', '$DB_USER');
define('DB_PASS', '$DB_PASS');
define('ENV', 'release');

// Ruta base para URLs
define('BASE_URL', 'http://localhost/intranet-release/');
?>
EOF

# 6. Asegurar permisos (opcional, ajusta según tu servidor)
chown -R www-data:www-data $RELEASE_DIR
chmod -R 755 $RELEASE_DIR

echo "✅ Entorno de liberación listo en $RELEASE_DIR"