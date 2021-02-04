## Project Setup
*   Laravel Sail : `composer require laravel/sail --dev`
*   To publish Sail's `docker-compose.yml` file : `php artisan sail:install`
*   To make Sail alias : `alias sail='bash vendor/bin/sail'`.
*   To start Sail : `sail up`, It will take some time to set up the container.
*   Application path: `http://0.0.0.0:80`

## Required Libraries
*   PHP Code Sniffer is a tool to detect violations
    of a defined coding standard such as PSR12 : `composer require "squizlabs/php_codesniffer=*" --dev`
