FROM php:8.2-apache

# Install PDO MySQL + Calendar
RUN docker-php-ext-install pdo pdo_mysql calendar

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set document root permissions (optional for local dev)
RUN chown -R www-data:www-data /var/www/html
