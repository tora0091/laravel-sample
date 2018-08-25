## Laravel Sample Application

Laravel sample application.

- PHP 7.3
- Laravel 5.6
- MySQL 5.7
- Ubuntu 16.04

## Memo

Setting

- git clone https://github.com/tora0091/laravel-sample.git
- php composer require
- write .env
- php artisan migrate
- php artisan serv
- access http://localhost:8000/

Login Page

- php artisan make:auth
- show routes/web.php

Database

- Repository pattern app/Repositories and app/Providers/AppServiceProvider.php

Validation

- app/Http/Requests
- custom validation app/Validator and app/Providers/ValidatorServiceProvider.php
- add config/app.php providers list

View

- resources/vies/layouts and schedule
- errors view resources/vies/errors
- server error catch app/Exceptions/Handler.php#renderHttpException
- mails template resources/vies/mails
- maintenance resources/vies/maintenance and app/Exceptions/Handler.php#renderHttpException
- pagination php artisan vendor:publish overwrite resources/vies/vendor/pagination
- helper app/Helpers/Helper.php and app/Providers/HelperServiceProvider.php and add config/app.php providers list

Maintenance Mode

- resources/vies/maintenance
- app/Exceptions/Handler.php#renderHttpException
- app/Http/Kernel.php middleware add app/Http/Middleware/CheckForMaintenanceMode
- start maintenance mode: php artisan down
- end maintenance mode: php artisan up
