# Usa una imagen base de PHP con Apache
FROM php:8.2-apache

# Cambiar el DocumentRoot
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Copia el código de la aplicación al directorio raíz del servidor web
# COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html

# Establecer el directorio de trabajo
WORKDIR /var/www/html

EXPOSE 80

# Instala extensiones adicionales de PHP si es necesario
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libzip-dev \
    && docker-php-ext-install mysqli pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer 

# Configura Apache
RUN a2enmod rewrite