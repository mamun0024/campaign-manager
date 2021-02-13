## Project Installation
*   Clone the project repository : `git clone https://github.com/mamun0024/campaign-manager.git`
*   Enter the `campaign-manager` folder and rename `.env-example` to `.env`
*   To install project dependencies : `composer install`
*   To make Sail alias : `alias sail='bash vendor/bin/sail'`
*   Run form project directory : `sail up`
*   Run form project directory to enter application container CLI : `sail exec laravel.test bash`
*   From application container CLI, run : `npm install`
*   From application container CLI, run : `npm run watch`
*   Project URL: `http://0.0.0.0:80`
*   From application container CLI, to create the schema : `php artisan migrate`
*   From application container CLI, to link a media file : 
    1. `rm public/storage`
    2. `php artisan storage:link`
*   From application container CLI, to run UNIT test : `php artisan test`
*   To enter mysql container CLI:
    1. `sail exec mysql bash`
    2. `mysql -uroot -proot`
*   To enter redis container CLI:
    1. `sail exec redis redis-cli`
    2. `info`
    3. `select 0`
*   Postman Collection path: `docs/Campaign Manager.postman_collection.json`

## Used Libraries
*   Laravel : `composer create-project laravel/laravel campaign-manager`
*   Laravel Sail : `composer require laravel/sail --dev`
*   PHP Code Sniffer is a tool to detect violations
    of a defined coding standard such as PSR12 : `composer require "squizlabs/php_codesniffer=*" --dev`
*   Laravel UI : `composer require laravel/ui`
*   Predis for redis : `composer require predis/predis`
