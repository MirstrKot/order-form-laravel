## Тестовая форма заказа

### Установка

1. Склонировать репозиторий и перейти в его папку `cd`
2. Собрать composer через `docker run --rm --interactive --tty --volume $PWD:/app composer install`
3. Поднять docker через `docker-compose up`
4. Выполнить Миграции и Seeder через `docker-compose exec app php artisan migrate:refresh --seed`
5. Перейти по [http://0.0.0.0:8080/](http://0.0.0.0:8080/)

### Технологии
 
- PHP 7.1.17 (Laravel 5.6)
- MySQL 5.6
- Vue.js 2
- Docker
- Composer
