FROM php:8.3

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

# Install dependencies and clear caches
RUN composer install
RUN php artisan key:generate
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=8000