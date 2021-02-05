## Project Installation
*   Clone the project repository : `git clone https://github.com/mamun0024/campaign-manager.git`
*   Enter the `campaign-manager` folder and rename `.env-example` to `.env` : `cp .env-example .env`
*   To install project dependencies : `composer install`
*   To make Sail alias : `alias sail='bash vendor/bin/sail'`
*   Run form project directory : `sail up`
*   Run form project directory to enter application root directory : `sail exec laravel.test bash`
*   Run : `npm install`
*   Run : `npm run watch`
*   Project URL: `http://0.0.0.0:80`
*   To create the schema : `php artisan migrate`
*   To link a media file : `php artisan storage:link`
*   To run UNIT test : `php artisan test for running unit tests`
*   To enter mysql CLI:
    1. `sail exec mysql bash`
    2. `mysql -uroot -proot`
*   To enter redis CLI:
    1. `sail exec redis redis-cli`
    2. `info`
    3. `select 1`

## Used Libraries
*   Laravel : `composer create-project laravel/laravel campaign-manager`
*   Laravel Sail : `composer require laravel/sail --dev`
*   PHP Code Sniffer is a tool to detect violations
    of a defined coding standard such as PSR12 : `composer require "squizlabs/php_codesniffer=*" --dev`
