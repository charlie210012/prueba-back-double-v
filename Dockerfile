# Utiliza la imagen base de PHP con Apache
FROM php:7.4-apache

# Instala dependencias necesarias
RUN apt-get update && \
    apt-get install -y \
    git \
    zip \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev

# Instala extensiones de PHP necesarias
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Configura el Document Root del servidor Apache
ENV APACHE_DOCUMENT_ROOT /var/www/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Habilita el módulo Apache mod_rewrite
RUN a2enmod rewrite

# Copia los archivos de la aplicación al contenedor
COPY . /var/www

# Configura los permisos adecuados
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establece el directorio de trabajo
WORKDIR /var/www

# Instala las dependencias de Composer
RUN composer install --no-interaction --no-dev --prefer-dist

# Establece las variables de entorno para Laravel
RUN cp .env.example .env
RUN php artisan key:generate

# Configura las variables de entorno para MySQL y phpMyAdmin
ENV DB_CONNECTION=mysql
ENV DB_HOST=db
ENV DB_PORT=3306
ENV DB_DATABASE=laravel_db
ENV DB_USERNAME=laravel_user
ENV DB_PASSWORD=secret

# Expone el puerto 80 para el servidor web
EXPOSE 80

# Ejecuta los comandos de inicio
CMD php artisan migrate --force && apache2-foreground
