FROM php:8.4-apache

# Instalar dependencias del sistema y extensiones de PHP para Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql gd zip mbstring bcmath xml

# Permitir ejecucion de Composer en el contenedor
ENV COMPOSER_ALLOW_SUPERUSER=1

# Activar modulo rewrite de Apache
RUN a2enmod rewrite

WORKDIR /var/www/html

# Copiar archivos del proyecto
COPY . .

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar dependencias ignorando la verificacion estricta de plataforma de Composer durante el build
RUN composer install --no-dev --no-scripts --optimize-autoloader --no-interaction --ignore-platform-reqs

# Configurar DocumentRoot de Apache apuntando a /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Permisos para almacenamiento y cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80