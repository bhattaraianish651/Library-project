
# Step 1: Base PHP image
FROM php:8.2-fpm

# Step 2: Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Step 3: Set working directory
WORKDIR /var/www

# Step 4: Copy project files
COPY . .

# Step 5: Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Step 6: Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Step 7: Expose port
EXPOSE 8000

# Step 8: Start Laravel server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
