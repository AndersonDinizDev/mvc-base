#!/bin/bash

if [ ! -f "vendor/autoload.php" ]; then
    composer install -q --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist
fi

if [ ! -f ".env" ]; then
    echo "Creating env file for env $APP_ENV"
    cp .env.example .env
else
    echo "env file exists."
fi

php-fpm -D
nginx -g "daemon off;"
