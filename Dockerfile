# Use the official PHP image as base
FROM php:8.1-fpm

# Copy composer.lock and composer.json into the working directory
COPY composer.lock composer.json /var/www/html/

# Set working directory
WORKDIR /var/www

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

# # Copy application files
# COPY . .

# # Install Composer dependencies
# RUN composer install

# # Expose port
# EXPOSE 9000

# # Start PHP-FPM server
# CMD ["php-fpm"]

# Copy existing application directory contents to the working directory
COPY . /var/www/html

# Assign permissions of the working directory to the www-data user
RUN chown -R www-data:www-data \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache

# Expose port 9000 and start php-fpm server (for FastCGI Process Manager)
EXPOSE 9000
CMD ["php-fpm"]