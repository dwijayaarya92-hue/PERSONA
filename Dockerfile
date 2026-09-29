FROM php:8.2-apache

# ========================================
# Install dependencies
# ========================================
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
    && rm -rf /var/lib/apt/lists/*


# ========================================
# Configure GD
# ========================================
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg


# ========================================
# PHP Extensions
# ========================================
RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    intl


# ========================================
# Apache Rewrite
# ========================================
RUN a2enmod rewrite


# ========================================
# Laravel public directory
# ========================================
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri \
    -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/000-default.conf \
    /etc/apache2/apache2.conf


# ========================================
# Composer
# ========================================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer


# ========================================
# Laravel
# ========================================
WORKDIR /var/www/html

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

COPY . .


# ========================================
# Laravel permissions
# ========================================
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


# ========================================
# Apache
# ========================================
EXPOSE 80

CMD ["apache2-foreground"]