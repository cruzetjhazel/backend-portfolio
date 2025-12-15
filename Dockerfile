# Use official PHP image with Apache
FROM php:8.2-apache

# Install system dependencies for PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-enable pdo_pgsql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy your app
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
