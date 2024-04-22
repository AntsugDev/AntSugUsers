# Utilizziamo un'immagine di PHP con Apache
FROM php:8.2-apache

# Installiamo le dipendenze necessarie per Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Abilitiamo il modulo Apache mod_rewrite
RUN a2enmod rewrite

# Impostiamo la directory di lavoro
WORKDIR /var/www/html

# Copiamo i file dell'applicazione nell'immagine Docker
COPY /php /var/www/html/php

# Installiamo le dipendenze di Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installiamo le dipendenze di PHP utilizzando Composer
RUN composer install

# Cambiamo i permessi dei file
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Esponiamo la porta 80
EXPOSE 90

# Comando predefinito per avviare Apache
CMD ["apache2-foreground"]
