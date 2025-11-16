
# PHP
FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git unzip curl nginx libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

WORKDIR /var/www

COPY . .

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

COPY nginx.conf /etc/nginx/conf.d/default.conf

ENV PORT=10000
EXPOSE 10000

CMD service nginx start && php-fpm
