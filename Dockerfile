FROM php:8.2-apache

# ========================================
# System dependencies
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
    nodejs \
    npm \
    && rm -rf /var/lib/apt/lists/*

# ========================================
# PHP extensions
# ========================================
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg

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
# Apache
# ========================================
RUN a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri \
    -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/000-default.conf \
    /etc/apache2/apache2.conf

# ========================================
# Apache ServerName
# Menghilangkan warning AH00558
# ========================================
RUN echo "ServerName persona.skb-prime.web.id" \
    > /etc/apache2/conf-available/servername.conf \
    && a2enconf servername

# ========================================
# Composer
# ========================================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# ========================================
# Laravel dependencies
# ========================================
COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

# ========================================
# Node / Vite dependencies
# ========================================
COPY package.json package-lock.json* ./

RUN npm install

# ========================================
# Copy Laravel source
# ========================================
COPY . .

# ========================================
# Build Vite
# ========================================
RUN npm run build

# ========================================
# Laravel directories
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