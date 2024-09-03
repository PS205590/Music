FROM php:8.3

# Install system dependencies and Node.js
RUN apt-get update -y && apt-get install -y openssl zip unzip git curl gnupg
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www
COPY . /var/www

# Ensure necessary file permissions
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Handle missing .env file
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Install PHP and Node.js dependencies
RUN composer install
RUN npm ci

# Set the port Vite will use
ENV VITE_PORT=5173

# Expose ports for PHP and Vite
EXPOSE 8000 5173

# Run PHP and Vite development servers
CMD php artisan serve --host=0.0.0.0 --port=8000 & npm run dev -- --host
