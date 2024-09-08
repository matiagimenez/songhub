# Usar la imagen base oficial de PHP con Apache
FROM php:8.1.2-apache

# Instalar extensiones necesarias, como MySQLi y PDO MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Instalar herramientas adicionales necesarias para Composer
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libzip-dev \
    && docker-php-ext-install zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar directorio de trabajo
WORKDIR /var/www/html

# Copiar los archivos de la aplicación al contenedor
COPY . .
COPY .env.prod .env

# Exponer el puerto 80
EXPOSE 80

# Instalar dependencias de Composer
RUN composer install --no-dev --optimize-autoloader




# CMD ["php", "-S", "0.0.0.0:80", "-t", "public/"]
