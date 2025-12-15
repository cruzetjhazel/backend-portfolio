FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    libpq-dev        # PostgreSQL client library

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd

# Enable Apache rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Apache config
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80

CMD ["apache2-foreground"]
