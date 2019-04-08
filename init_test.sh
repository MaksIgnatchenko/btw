#!/bin/bash
set -e

chmod 777 -R storage/ bootstrap/cache

composer install
composer dump-autoload

cp .env.testing .env

rm -f ./public/storage
ln -s ../storage/app/public/ ./public/storage

php phpunit.phar -c ./phpunit.xml