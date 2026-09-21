# ==========================================
# Stage 1 - Build Frontend Assets (Node.js)
# ==========================================
FROM node:20-alpine AS frontend

WORKDIR /app

COPY package.json package-lock.json ./

RUN npm ci

COPY vite.config.js ./
COPY resources/ ./resources/

RUN npm run build


# ==========================================
# Stage 2 - Laravel + PHP 8.2 FPM + Nginx
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
# Copy built frontend assets from Stage 1
# ------------------------------------------
COPY --from=frontend /app/public/build/ ./public/build/

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
# Entrypoint script (migration + seed)
# ------------------------------------------
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# ------------------------------------------
# Persona application port
# ------------------------------------------
EXPOSE 80

# ------------------------------------------
# Run migration, seed, then start services
# ------------------------------------------
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
