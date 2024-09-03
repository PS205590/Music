# Stage 1: Build Stage
FROM node:18 as node_builder

WORKDIR /var/www
COPY package*.json ./

# Install Node.js dependencies
RUN npm ci

# Copy source files and build assets using Vite
COPY . .
RUN npm run build

# Stage 2: PHP Stage
FROM php:8.3

# Install PHP extensions and system dependencies
RUN apt-get update -y && apt-get install -y openssl zip unzip git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www
COPY . /var/www

# Ensure necessary file permissions
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Handle missing .env file
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy over the built assets from the previous stage
COPY --from=node_builder /var/www/public/build /var/www/public/build

# Clear and cache Laravel configurations
RUN php artisan key:generate
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000
