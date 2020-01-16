@echo off

copy .env.docker .env
composer dumpa
composer install
npm install
docker cp . projet-symfony-web:/var/www/project
docker-compose up --build -d
docker exec -it projet-symfony-web bash -c "chmod -R 777 /var/www/project/var/cache/dev && chmod -R 777 /var/www/project/var/log && chmod -R 777 /var/log"
