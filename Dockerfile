# ==========================================
# Persona - Laravel 12
# PHP 8.2
# ==========================================

FROM php:8.2-cli

# ------------------------------------------
# System dependencies
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
# GD
# ------------------------------------------
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg

# ------------------------------------------
# PHP extensions
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
# Composer
# ------------------------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# ------------------------------------------
# Composer dependencies
# ------------------------------------------
COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

# ------------------------------------------
# Laravel application
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
# Permissions
# ------------------------------------------
RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache

RUN chmod -R 775 \
    storage \
    bootstrap/cache

# ------------------------------------------
# Laravel HTTP server
# ------------------------------------------
EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]