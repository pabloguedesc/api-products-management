#!/bin/bash
php artisan config:cache
php artisan config:clear
php artisan migrate --force
php artisan db:seed --force
php artisan serve --host=0.0.0.0 --port=8000
