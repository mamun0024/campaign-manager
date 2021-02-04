## Project Installation
*   To make Sail alias : `alias sail='bash vendor/bin/sail'`.
*   Run form project directory : `sail up`;
*   Project URL: `http://0.0.0.0:80`
*   Run form project directory to enter application root directory : `sail exec laravel.test bash`
*   To install composer : `composer install`
*   To create the schema : `php artisan migrate`
*   To link a media file : `php artisan storage:link`
*   To run UNIT test : `php artisan test for running unit tests`
    
## Initial Project Setup Guide
*   Laravel Sail : `composer require laravel/sail --dev`
*   To publish Sail's `docker-compose.yml` file : `php artisan sail:install`
*   To make Sail alias : `alias sail='bash vendor/bin/sail'`.
*   To start Sail : `sail up`, It will take some time to set up the container.
*   To enter mysql CLI:
    1. `sail exec mysql bash`
    2. `mysql -uroot -proot`
*   To enter redis CLI:
    1. `sail exec redis redis-cli`
    2. `info`
    3. `select 1`

## Required Libraries
*   PHP Code Sniffer is a tool to detect violations
    of a defined coding standard such as PSR12 : `composer require "squizlabs/php_codesniffer=*" --dev`
