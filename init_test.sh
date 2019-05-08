#!/bin/bash
set -e

chmod 777 -R storage/ bootstrap/cache

composer install
composer dump-autoload

rm -f ./public/storage
ln -s ../storage/app/public/ ./public/storage
php artisan jwt:secret -f
vendor/bin/phpunit -c ./phpunit.xml