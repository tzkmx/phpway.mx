FROM php:7-apache

RUN rm -rf /var/www/html && ln -s /app/web /var/www/html
