# Use the official PHP image as base
FROM php:8.1-fpm

# Establece el directorio de trabajo dentro del contenedor
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    libpq-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-configure pdo_pgsql --with-pdo-pgsql=/usr/local/pgsql
RUN docker-php-ext-install gd pdo pdo_pgsql zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy application files
COPY . .

# Install Composer dependencies
RUN composer install

# Expose port
EXPOSE 9000

# Start PHP-FPM server
CMD ["php-fpm"]


