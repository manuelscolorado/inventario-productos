FROM php:8.2-fpm-alpine

# Instalar dependencias del sistema
RUN apk --no-cache add \
    git \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    unzip \
    icu-dev \
    oniguruma-dev \
    libxml2-dev

# Instalar extensiones de PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql intl mbstring xml bcmath

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crear directorio de trabajo
WORKDIR /var/www

# Copiar archivos de la aplicación
COPY . /var/www

# Instalar dependencias de PHP
RUN composer install --no-scripts --no-autoloader

# Permisos para la carpeta de almacenamiento
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Exponer el puerto 9000 y lanzar el servicio PHP-FPM
EXPOSE 9000
CMD ["php-fpm"]
