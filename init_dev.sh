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

service supervisor start
supervisorctl reread
supervisorctl update
supervisorctl restart all
php artisan queue:restart

php artisan up
