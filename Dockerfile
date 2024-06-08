# Usar una imagen base de PHP 5.6 con Apache
FROM php:5.6-apache

# Cambiar los repositorios a los de archivo de Debian y eliminar los repositorios de seguridad y actualizaciones
RUN sed -i 's|http://deb.debian.org/debian|http://archive.debian.org/debian|g' /etc/apt/sources.list && \
    sed -i '/security.debian.org/d' /etc/apt/sources.list && \
    sed -i '/stretch-updates/d' /etc/apt/sources.list && \
    sed -i '/deb-src/d' /etc/apt/sources.list && \
    echo 'Acquire::Check-Valid-Until "false";' > /etc/apt/apt.conf.d/99no-check-valid-until && \
    apt-get update && \
    apt-get install -y --no-install-recommends \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    mariadb-client && \
    docker-php-ext-install mysql mysqli && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Establecer la zona horaria en php.ini
RUN echo "date.timezone = 'America/Bogota'" > /usr/local/etc/php/conf.d/timezone.ini

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Copiar el contenido de la aplicación al directorio raíz de Apache
COPY . /var/www/html/

# Establecer permisos correctos
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80
EXPOSE 80

# Comando para iniciar Apache en el contenedor
CMD ["apache2-foreground"]
