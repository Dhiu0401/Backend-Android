FROM php:7.4-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]

RUN echo "Options -Indexes" >> /etc/apache2/apache2.conf
