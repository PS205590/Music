# Stage 1: Build the application
FROM php:8.2-fpm-alpine as build

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo_mysql zip bcmath \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy the application
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

# Copy environment file
COPY .env.example .env

# Generate application key
RUN php artisan key:generate

# Expose port 8000 and start php-fpm server
EXPOSE 8000

CMD ["php-fpm"]
