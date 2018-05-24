## Тестовая форма заказа

### Установка

1. Собрать composer через `composer install`
2. Поднять docker через `docker-compose up`
3. Выполнить Миграции и Seeder через `artisan migrate:refresh --seed` внутри докера или `docker-compose exec app php artisan migrate:refresh --seed` снаружи

### Технологии
 
- PHP 7.1.17 (Laravel 5.6)
- MySQL 5.6
- Vue.js 2
- Docker
- Composer
