# ==========================================
# Persona - Laravel 12 - PHP 8.2 FPM
# ==========================================

FROM php:8.2-fpm

# ------------------------------------------
# Install system dependencies
# ------------------------------------------
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# ------------------------------------------
# Configure GD
# ------------------------------------------
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg

# ------------------------------------------
# Install PHP extensions
# ------------------------------------------
RUN docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    intl

# ------------------------------------------
# Install Composer
# ------------------------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ------------------------------------------
# Working directory
# ------------------------------------------
WORKDIR /var/www/html

# ------------------------------------------
# Copy Composer files first
# ------------------------------------------
COPY composer.json composer.lock ./

# ------------------------------------------
# Install Laravel dependencies
# ------------------------------------------
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

# ------------------------------------------
# Copy Laravel project
# ------------------------------------------
COPY . .

# ------------------------------------------
# Laravel directories
# ------------------------------------------
RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

# ------------------------------------------
# Laravel permissions
# ------------------------------------------
RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache

RUN chmod -R 775 \
    storage \
    bootstrap/cache

# ------------------------------------------
# PHP-FPM
# ------------------------------------------
EXPOSE 9000

# ------------------------------------------
# Start PHP-FPM only
# ------------------------------------------
CMD ["php-fpm"]