# DCN CMS
An open source, simple CMS

- [About](#about)
- [Features](#features)
- [Install](#install)
    - [Requirements](#requirements)
    - [Get Code](#get-code)
    - [Configuration](#configuration)
    - [Database](#database)
- [Customization](#customization)
    - [Blade Views](#blade-views)
    - [CSS & LESS](#css-and-less)
    - [Javascript](#javascript)
    - [Grunt](#grunt)
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

## Customization
Customizing is easy!

### Blade Views
Because this CMS is based on Laravel; we use [blades](http://laravel.com/docs/master/blade) for all of our views.

The default blades are stored in `resources/views`, and overriding blades are stored in `site-templates`

For Example:  
`touch site-templates/frontend.blade.php`  
Will render all pages, with the exception of the API and Admin routes, with a blank page.

### CSS and LESS
The default LESS files are stored in `public/assets/stylesheets` and are compiled and stored in `public/css`

By default grunt makes 6 files. `backend.css`,`frontend.css`, and `portal.css` each with a minimized version.

There is also a `public/css/style.css` file for raw css if you need it.

### JavaScript
The default JS files are stored in `public/assets/javascript` and are compiled and stored in `public/js`

By default grunt makes 6 files. `backend.js`,`frontend.js`, and `portal.js` each with a minimized version.

The `public/assets/javascript/includes` folder should be left alone. As it is simply a storage place for grunt to combine all files together.

Within the `public/assets/javascript` folder there are `.inc` files and `.js` files.

The `.inc` files are used to include vendor `.js` files into one, while the `.js` is for your custom area wide javascript.

### Grunt
Simply run grunt watch when customizing and your less, javascript, and other changes will automatically be compiled for use.


## License
This software is licensed under the unlicensed licensed.

Sounds complicated, but its not. You can do with this project, anything you wish. 

We just won't always help if something breaks.