#! /bin/bash

# Update package index
apt update

# Install Node.js and npm
apt install -y nodejs npm

cd /var/www/html

npm install

php artisan queue:work
