FROM php:8.2-fpm

RUN apt update && apt install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev
RUN apt clean && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
COPY conf/entrypoint.sh  /usr/local/bin/entrypoint.sh

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html/antsug
COPY . .



RUN composer install

CMD ["chmod +x /var/www/html/antsug/conf/entrypoint.sh","/var/www/html/antsug/conf/entrypoint.sh"]
