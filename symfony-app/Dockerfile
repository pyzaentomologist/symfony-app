# Use the official PHP image as the base image
FROM php:8.2-fpm

# Set the working directory in the container
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs

# Install Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

# Copy composer files and install dependencies
COPY composer.json composer.lock ./
# Install Composer dependencies
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-scripts --no-autoloader --no-interaction

# Copy application code
COPY . .

# Change directory to project root
WORKDIR /var/www/html

# Install npm packages
COPY package.json package-lock.json ./
RUN npm install

# Generate the autoloader
RUN composer dump-autoload --optimize

# Run Symfony post-installation script
RUN composer run-script post-install-cmd

# Expose port 8000 to the Docker host
EXPOSE 8000

# Start PHP-FPM
CMD ["php-fpm"]