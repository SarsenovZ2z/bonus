#!/bin/bash

composer dump-autoload

sudo chmod 777 -R storage
sudo chmod 777 -R bootstrap

php artisan migrate:fresh
php artisan db:seed --force

php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

sudo chmod 777 -R storage
sudo chmod 777 -R bootstrap
