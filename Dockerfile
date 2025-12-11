FROM php:8.2-apache

WORKDIR /var/www/html

# Cần pdo_mysql để kết nối MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Copy code vào image
COPY public/ /var/www/html/
COPY config.php /var/www/html/config.php

EXPOSE 80
