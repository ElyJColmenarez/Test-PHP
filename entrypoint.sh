#!/bin/sh

# Esperar a que PostgreSQL esté listo
until pg_isready -h db -U postgres; do
    echo "Esperando a PostgreSQL..."
    sleep 2
done

# Ejecutar migraciones y comandos necesarios
composer update
php artisan migrate --force
php artisan db:seed --force

# Iniciar PHP-FPM
exec php-fpm
