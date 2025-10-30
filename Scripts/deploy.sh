#!/bin/bash
# scripts/deploy.sh

echo "🚀 Iniciando despliegue a producción..."

PROD_DIR="/var/www/intranet-prod"
BACKUP_DIR="/var/backups/intranet-$(date +%Y%m%d-%H%M)"

# 1. Hacer respaldo
echo "💾 Creando respaldo..."
mkdir -p $BACKUP_DIR
cp -r $PROD_DIR/* $BACKUP_DIR/

# 2. Copiar nueva versión
cp -r ./* $PROD_DIR/

# 3. Instalar dependencias Composer en producción
cd $PROD_DIR
composer install --no-dev --optimize-autoloader

# 4. Asegurar permisos (ajusta según tu servidor)
chown -R www-data:www-data $PROD_DIR
chmod -R 755 $PROD_DIR

# 5. Reiniciar servicios si es necesario (por ejemplo, Apache)
# sudo systemctl restart apache2

echo "✅ Despliegue completado. Backup en: $BACKUP_DIR"
echo "ℹ️  Si hay error, restaura con: cp -r $BACKUP_DIR/* $PROD_DIR/"