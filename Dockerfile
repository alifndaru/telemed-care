FROM php:8.3-fpm-alpine

# Install dependencies
RUN apk add --no-cache \
    postgresql-dev \
    libpq \
    libzip-dev \
    zip \
    unzip \
    git

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql zip

RUN apk add --no-cache bash

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory
COPY . .

# Install project dependencies
RUN composer install

# Set permissions
RUN chown -R www-data:www-data /var/www
