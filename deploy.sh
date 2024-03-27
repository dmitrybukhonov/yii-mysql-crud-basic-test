#!/bin/bash

if [[ -f .env ]]; then
    echo "Pull master branch"
    git pull origin master

    echo "composer install"
    php yii2 composer install --no-interaction --prefer-dist --optimize-autoloader --ignore-platform-reqs

    echo "Start migration"
    php yii migrate --migrationPath=@app/modules/subscribe/migrations --interactive=0
    php yii migrate --migrationPath=@app/modules/bookcatalog/migrations --interactive=0
    php yii migrate --migrationPath=@app/modules/image/migrations --interactive=0

    echo "Login details: admin/admin"
else
    echo "The .env file does not exist. Please create a .env file before running composer install and migration."
fi