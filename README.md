# Разворачивание проекта

## Находясь в папке с загруженным проектом

Установить зависимости composer
```sh
composer install
php artisan key:generate
```

Заполнить переменные окружения
```sh
cp .env.example .env
nano .env
```

Установить права к файлам и деррикториям (для Linux)
```sh
sudo chown -R $USER:www-data .
sudo find . -type f -exec chmod 664 {} \;
sudo find . -type d -exec chmod 775 {} \;
sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache
```

Заполнить БД
```sh
php artisan migrate --seed
```

Установить зависимости npm и запустить сборку ресурсов
```sh
npm install
npm run build
```

Для правильной работы необходимо запустить следующие процессы:
```sh
php artisan queue:work
php artisan reverb:start
```
