FROM php:8.1-fpm
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    && docker-php-ext-install zip pdo pdo_mysql
COPY . /app
WORKDIR /app
RUN chmod -R 775 /app/storage
COPY start.sh /app
