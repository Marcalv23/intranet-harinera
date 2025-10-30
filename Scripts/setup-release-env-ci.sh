#!/bin/bash
echo "🔧 Configurando entorno de liberación (CI)..."

# Tu Connection.php espera:
# - host: localhost
# - dbname: base4
# - user: root
# - pass: (vacío)

DB_NAME="base4"
ROOT_PASS="${DB_ROOT_PASS:-rootpass123}"

# Crear la base de datos llamada "base4"
mysql -h 127.0.0.1 -P 3306 -u root -p"$ROOT_PASS" -e "DROP DATABASE IF EXISTS \`$DB_NAME\`;"
mysql -h 127.0.0.1 -P 3306 -u root -p"$ROOT_PASS" -e "CREATE DATABASE \`$DB_NAME\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Cargar el esquema
mysql -h 127.0.0.1 -P 3306 -u root -p"$ROOT_PASS" "$DB_NAME" < base4.sql

echo "✅ Base de datos 'base4' creada y cargada."
