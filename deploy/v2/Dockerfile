FROM php:8.1-alpine

RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo_mysql zip

# set workdir
WORKDIR /var/www/html

COPY . /var/www/html

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-scripts --no-autoloader

# configure permission
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 /var/www/html/storage

# generate autoload files and optimization of Composer
RUN composer dump-autoload --optimize

# clean unused files
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# start PHP-FPM
CMD ["php-fpm"]
