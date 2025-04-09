# Usar imagen base de PHP 8.4
FROM php:8.4-fpm-alpine

WORKDIR /var/www

# 1. Instalar dependencias del sistema (incluyendo Node.js y npm)
RUN apk update && apk add --no-cache \
    postgresql-dev \
    postgresql-client \
    libpng-dev \
    libzip-dev \
    nodejs \
    npm \
    git \
    unzip \
    curl

# 2. Instalar extensiones PHP
RUN docker-php-ext-install pdo_pgsql gd zip

# 3. Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Copiar TODO el proyecto
COPY . .

# 5. Instalar dependencias PHP y NPM
RUN composer install \
    && npm install \
    && npm run build

# 6. Configurar permisos y generar APP_KEY
RUN php artisan key:generate --force

COPY entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh


USER root
CMD ["entrypoint.sh"]
