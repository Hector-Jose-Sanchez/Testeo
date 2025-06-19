FROM php:8.2-apache

# Instalar extensiones necesarias
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    unzip \
    zip \
    git \
    curl \
    libpng-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring zip exif pcntl

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copiar todo el proyecto a /var/www
COPY . /var/www
WORKDIR /var/www

# Apuntar Apache al directorio /public de Laravel
RUN rm -rf /var/www/html && ln -s /var/www/public /var/www/html

# Habilitar mod_rewrite para URLs amigables
RUN chown -R www-data:www-data /var/www \
    && a2enmod rewrite

# Instalar dependencias PHP y JS
RUN composer install --no-interaction --prefer-dist --optimize-autoloader \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && npm install \
    && npm run build

# Exponer puerto 80
EXPOSE 80
