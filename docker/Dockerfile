# Use an official PHP runtime as a parent image
#FROM node:latest AS node
FROM php:8.3

#COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
#COPY --from=node /usr/local/bin/node /usr/local/bin/node
#RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

# Set the working directory in the container
WORKDIR /var/www/html

# Install any needed packages specified in the requirements.txt
RUN apt-get update && apt-get install -y \ 
    libzip-dev \
    unzip \
    && docker-php-ext-install zip

RUN apt-get update \
    && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy composer.json and composer.lock
COPY composer.json composer.lock ./

# Install Laravel dependencies
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN composer install --no-scripts --no-autoloader

# Copy the rest of the application code
COPY . .

# Generate application key
RUN composer dump-autoload --optimize

# Decrypt .env file
RUN php artisan env:decrypt --key=base64:voIs0vIdk5HGMarLLeryXdur65LgdaOEkNfS1ujEdpg=
RUN php artisan key:generate

# Create storage directory and set permissions
RUN mkdir -p storage/framework/{cache,sessions,views} \
    && chown -R www-data:www-data storage

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
CMD php artisan serve --host=0.0.0.0 --port=8000
