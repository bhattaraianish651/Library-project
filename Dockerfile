# ---- Step 1: Base PHP Image ----
FROM php:8.2-fpm

# ---- Step 2: Install system dependencies ----
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# ---- Step 3: Copy project files ----
WORKDIR /var/www
COPY . .

# ---- Step 4: Install composer ----
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# ---- Step 5: Set permissions ----
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# ---- Step 6: Generate Laravel key and clear caches ----
RUN php artisan key:generate && \
    php artisan config:clear && \
    php artisan cache:clear && \
    php artisan view:clear

# ---- Step 7: Expose port and start server ----
EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
