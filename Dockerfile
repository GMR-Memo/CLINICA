# Usamos PHP 8.1 con Apache
FROM php:8.1-apache

# Activamos mod_rewrite para URLs amigables
RUN a2enmod rewrite

# Instalamos extensiones necesarias para PostgreSQL
RUN docker-php-ext-install pdo pdo_pgsql

# Copiamos el proyecto al contenedor
COPY . /var/www/html/

# Cambiamos permisos para Apache
RUN chown -R www-data:www-data /var/www/html

# Variables de entorno para conexión local (puerto 5433)
ENV APP_ENV=local
ENV DB_HOST=host.docker.internal
ENV DB_PORT=5433
ENV DB_NAME=ClinicaSalud
ENV DB_USER=postgres
ENV DB_PASSWORD=root1234

# Exponemos puerto 80 para Apache
EXPOSE 80
