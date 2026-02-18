FROM serversideup/php:8.3-fpm-nginx

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Copy project files
COPY --chown=www-data:www-data . /var/www/html

# Install Composer dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Fix permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port
EXPOSE 80