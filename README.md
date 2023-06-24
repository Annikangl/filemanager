# Laravel File Manager

# Требования к системе

* Установленный Docker и Docker Compose
* Установленный composer

Product built with **PHP 8.1**, **Laravel 10**, **Docker** from **Laravel Sail**

# Инструкция по развертыванию

1. Склонировать проект: `git clone git@github.com:Annikangl/filemanager.git`
2. Сконфигурировать файл окружения .env: cp .env-example .env
3. Сгенерировать ключ: php artisan key:generate
4. Настроить подключение к базе данных в файле .env:  **DB_PORT= DB_DATABASE= DB_USERNAME= DB_PASSWORD=**
5. Собрать приложение через Sail: ./vendor/bin/sail up
6. Выполнить миграции базы данных: ./vendor/bin/sail php artisan migrate
7. Настройте выполнение задач планировщика Laravel. Для этого вам нужно добавить в крон задачу, которая будет вызывать команду schedule:run Laravel. Введите следующую команду в терминале, чтобы открыть файл крона:

`crontab -e`

Добавьте следующую строку в файл крона для выполнения задач планировщика Laravel каждую минуту:

`* * * * * cd /path/to/your/laravel/project && php artisan schedule:run >> /dev/null 2>&1`
   
