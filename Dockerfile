# Imagen base con Apache y PHP 8.1
FROM php:8.1-apache

# Activar mod_rewrite de Apache
RUN a2enmod rewrite

# Instalar extensiones para PostgreSQL
RUN docker-php-ext-install pdo pdo_pgsql

# Copiar todo el código del proyecto al servidor
COPY . /var/www/html/

# Dar permisos adecuados
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80 (para la web)
EXPOSE 80
