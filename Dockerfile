FROM php:7-apache
MAINTAINER Kevin Urbainczyk <kevin@rays3t.info>

ADD src/ /var/www/html/
RUN chown -R www-data:www-data /var/www/html/* && chmod -R 775 /var/www/html/*

CMD ["apache2-foreground"]