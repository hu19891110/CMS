# DCN CMS
An open source, simple CMS

- [About](#about)
- [Features](#features)
- [Install](#install)
    - [Requirements](#requirements)
    - [Get Code](#get-code)
    - [Configuration](#configuration)
    - [Database](#database)
- [License](#license)

## About
This is a basic website backend developed by CloudMy.IT LLC's DynamicCode.Ninja Project Team.

It is open source, and you are more than welcome to develop, contribute, and use this how ever you choose.

## Features

Features include:

- User Management
- Page Management
- ContentBuilder Inline Page Editing

```
ContentBuilder Not Included! [Buy Here](http://innovastudio.com/content-builder.aspx)
```

## Install
Installation is simple.

### Requirements
For installation we assume that you have met the requirements for laravel 5.1

Additionally, we assume you have installed and configured:
- composer
- bower
- grunt (Optional, Mainly for development & Customizations)

### Get Code
You can get the code by running the following commands:

```
git clone git@github.com:DynamicCodeNinja/CMS.git ./
chmod -R 777 storage/
chmod -R 777 bootstrap/cache/
chmod 777 public/images
composer install
bower install
cp .env.example .env
```

### Configuration
Now we need to configure the application. Because its based on Laravel, simply edit the `.env` file and configure with your server settings. 

Next we need to install ContentBuilder

Upload the `ContentBuilder.zip` to `public/assets/vendor` and extract it.

It should look like this:

```
public/assets/vendor/ContentBuilder/assets,
public/assets/vendor/ContentBuilder/assets/...,
public/assets/vendor/ContentBuilder/scripts,
public/assets/vendor/ContentBuilder/scripts/...
public/assets/vendor/ContentBuilder/readme.txt,
public/assets/vendor/ContentBuilder/...,
```

### Database
Initial database setup, and seeding can be done by following these commands:

```
php artisan migrate
php artisan db:seed
```

    
## License
This software is licensed under the unlicensed licensed.

Sounds complicated, but its not. You can do with this project, anything you wish. 

We just won't always help if something breaks.