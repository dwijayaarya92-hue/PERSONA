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
    nginx \
    supervisor \
    && rm -rf /var/lib/apt/lists/*

# ------------------------------------------
# PHP extensions
# ------------------------------------------
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg

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
# Untuk mempercepat Docker build cache
# ------------------------------------------
COPY composer.json composer.lock ./

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
# Laravel permissions
# ------------------------------------------
RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache

RUN chmod -R 775 \
    storage \
    bootstrap/cache

# ------------------------------------------
# Nginx configuration
# ------------------------------------------
RUN rm -f /etc/nginx/sites-enabled/default

COPY docker/nginx/default.conf \
    /etc/nginx/conf.d/default.conf

# ------------------------------------------
# Supervisor configuration
# ------------------------------------------
COPY docker/supervisord.conf \
    /etc/supervisor/conf.d/supervisord.conf

# ------------------------------------------
# Persona application port
# ------------------------------------------
EXPOSE 80

# ------------------------------------------
# Start PHP-FPM + Nginx
# ------------------------------------------
CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/supervisord.conf"]