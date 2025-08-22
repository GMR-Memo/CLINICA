FROM php:8.1-apache

# Activar mod_rewrite de Apache
RUN a2enmod rewrite

# Instalar dependencias necesarias para compilar pdo_pgsql
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copiar el código al contenedor
COPY . /var/www/html/

# Cambiar permisos para Apache
RUN chown -R www-data:www-data /var/www/html

# Variables de entorno para conexión local (puerto 5433)
ENV APP_ENV=production
#ENV DB_HOST=host.docker.internal
ENV DB_PORT=5432
#ENV DB_NAME=ClinicaSalud
#ENV DB_USER=postgres
#ENV DB_PASSWORD=root1234

# Exponer puerto 80 para Apache
EXPOSE 80
