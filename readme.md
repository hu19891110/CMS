# DCN CMS

This is the CMS developed for use by DynamicCode.Ninja clients

Please feel free to use it for your own project; The only request is you open a ticket for any issues you experience.

## Install
For installation we assume that you have met the requirements for laravel 5.1
Additionally, we assume you have installed and configured:  
1. composer
1. bowser



asdfasdf

1. git clone git@github.com:DynamicCodeNinja/CMS.git ./
1. sudo chmod -R o+w storage/
1. sudo chmod -R o+w bootstrap/cache/
1. composer install
1. composer update
1. bower install
1. cp .env.example .env
1. vi .env // Configure settings for laravel
1. php artisan migrate
1. php artisan db:seed