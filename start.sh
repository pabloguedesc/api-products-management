#!/bin/bash

# Espera até que o MySQL esteja pronto
while ! nc -z db 3306; do
  sleep 0.1
done

# Verifica se a pasta vendor existe
if [ ! -d "vendor" ]; then
    composer install
fi

# Limpa e recacheia as configurações
php artisan config:cache
php artisan config:clear

# Executa as migrações e semeia o banco de dados
php artisan migrate --force
php artisan db:seed --force

# Inicia o servidor Laravel
php artisan serve --host=0.0.0.0 --port=8000
