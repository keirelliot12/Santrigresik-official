# Force rebuild - v20250219-0430
ARG BASE_IMAGE=serversideup/php:8.3-fpm-nginx
FROM ${BASE_IMAGE}

USER root

# Install dependencies (intl sudah ada di base image)
RUN apt-get update && apt-get install -y \
    git curl zip unzip \
    && rm -rf /var/lib/apt/lists/*

# Copy project
COPY --chown=www-data:www-data . /var/www/html

# Create empty SQLite database (required for composer package:discover)
RUN touch /var/www/html/database/database.sqlite \
    && chown www-data:www-data /var/www/html/database/database.sqlite

# Set cache driver ke array untuk build (tidak butuh DB)
ENV CACHE_DRIVER=array
ENV SESSION_DRIVER=file

# Install composer WITHOUT scripts first
RUN composer install --no-interaction --optimize-autoloader --no-dev --no-scripts

# Generate autoload
RUN composer dump-autoload --optimize

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
