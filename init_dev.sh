#!/bin/bash
set -e

cd /var/www

chmod -R 777 storage/ bootstrap/cache

php artisan down

php artisan migrate --force
php artisan route:clear
php artisan view:clear
php artisan config:clear
php artisan cache:clear

php artisan up
