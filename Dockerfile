FROM serversideup/php:8.3-fpm-nginx

USER root

# Install dependencies & PHP extensions
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev libicu-dev zip unzip \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install intl

# Copy project
COPY --chown=www-data:www-data . /var/www/html

# Install composer
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Fix permissions (Tetap root saat build untuk chmod)
RUN mkdir -p /var/www/html/storage/logs \
    /var/www/html/storage/app \
    /var/www/html/storage/framework/cache \
    /var/www/html/storage/framework/sessions \
    /var/www/html/storage/framework/views \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Bersihkan config nginx sisa jika ada
RUN rm -f /var/www/html/nginx.conf /var/www/html/default.conf

# Pre-create storage link
RUN ln -sf /var/www/html/storage/app/public /var/www/html/public/storage || true

# PENTING: JANGAN pakai "USER www-data" di sini. 
# Biarkan S6 Overlay start sebagai root untuk inisialisasi Nginx.

ENV AUTORUN_ENABLED=false
ENV AUTORUN_LARAVEL_MIGRATIONS=false
ENV PHP_FPM_PM_MAX_CHILDREN=20

EXPOSE 8080
