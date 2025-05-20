#!/bin/bash

# Install PHP with required extensions
apt-get update
apt-get install -y php-cli php-fpm php-pgsql php-curl php-mbstring php-xml php-zip

# Install composer
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install project dependencies
composer install --no-dev

# Build frontend assets
npm ci
npm run build

# Clear Laravel caches
php artisan config:clear