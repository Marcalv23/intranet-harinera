#!/bin/bash
echo "🔧 Configurando entorno de liberación (CI)..."

DB_NAME="intranet_test"
DB_USER="testuser"
DB_PASS="testpass"
ROOT_PASS="${DB_ROOT_PASS:-rootpass123}"

# Crear base de datos y usuario
mysql -h 127.0.0.1 -P 3306 -u root -p"$ROOT_PASS" -e "DROP DATABASE IF EXISTS $DB_NAME;"
mysql -h 127.0.0.1 -P 3306 -u root -p"$ROOT_PASS" -e "CREATE DATABASE $DB_NAME CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -h 127.0.0.1 -P 3306 -u root -p"$ROOT_PASS" -e "CREATE USER IF NOT EXISTS '$DB_USER'@'%' IDENTIFIED BY '$DB_PASS';"
mysql -h 127.0.0.1 -P 3306 -u root -p"$ROOT_PASS" -e "GRANT ALL PRIVILEGES ON $DB_NAME.* TO '$DB_USER'@'%';"
mysql -h 127.0.0.1 -P 3306 -u root -p"$ROOT_PASS" -e "FLUSH PRIVILEGES;"

# Cargar esquema
mysql -h 127.0.0.1 -P 3306 -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" < base4.sql

# Crear config.php en la raíz
cat > config.php <<EOF
<?php
define('DB_HOST', '127.0.0.1');
define('DB_PORT', '3306');
define('DB_NAME', '$DB_NAME');
define('DB_USER', '$DB_USER');
define('DB_PASS', '$DB_PASS');
define('ENV', 'ci');
?>
EOF

echo "✅ Entorno de CI listo."
