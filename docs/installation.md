# Installation

## Table of contents

- [Before you begin](#before-you-begin)
- [Manual installation](#manual-installation)
    - [Requirements](#requirements)
    - [Setup application](#setup-application)
    - [Authentication](#authentication)
    - [Configure your web server](#configure-your-web-server)
    - [Single domain installtion](#single-domain-installation)
    - [Video instruction](#video-instruction)

## Before you begin

1. If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

2. Install composer-asset-plugin needed for yii assets management

```bash
composer global require "fxp/composer-asset-plugin"
```

### Get source code

#### Download sources

https://github.com/Beaten-Sect0r/yii2-core/archive/master.zip

#### Or clone repository manually

```
git clone https://github.com/Beaten-Sect0r/yii2-core.git
```

#### Install composer dependencies

```
composer install --prefer-dist
```

### Get source code via Composer

You can install this application template with `composer` using the following command:

```
composer create-project --prefer-dist --stability=dev beaten-sect0r/yii2-core
```

## Manual installation

### Requirements

The minimum requirement by this application template that your Web server supports PHP 5.5.0.
Required PHP extensions:
- intl
- gd
- mcrypt

### Setup application

1. Copy `.env.dist` to `.env` in the project root.

2. Adjust settings in `.env` file
	- Set debug mode and your current environment

	```
	YII_DEBUG = true
	YII_ENV = dev
	```

	- Set DB configuration

	```
	DB_DSN = mysql:host=localhost;port=3306;dbname=yii2-core
	DB_USERNAME = user
	DB_PASSWORD = password
	```

	- Set application canonical urls

	```
	FRONTEND_URL = http://yii2-core.dev
	BACKEND_URL = http://backend.yii2-core.dev
	STORAGE_URL = http://storage.yii2-core.dev
	```

3. Run in command line

```
php yii app/setup
```

### Authentication

`administrator` role account

```
Login: Administrator
Password: passwd
```

### Configure your web server

Or configure your web server with three different web roots:
- yii2-core.dev => /path/to/yii2-core/frontend/web
- backend.yii2-core.dev => /path/to/yii2-core/backend/web
- storage.yii2-core.dev => /path/to/yii2-core/storage

### Single domain installation

#### Setup application

Adjust settings in `.env` file

```
FRONTEND_URL = http://yii2-core
BACKEND_URL = http://yii2-core/backend
STORAGE_URL = http://yii2-core/storage
```

Adjust settings in `backend/config/main.php` file

```
    ...
    'components'=>[
        ...
        'request' => [
            'baseUrl' => '/backend',
        ...
```

Adjust settings in `frontend/config/main.php` file

```
    ...
    'components'=>[
        ...
        'request' => [
            'baseUrl' => '',
        ...
```

#### Configure your web server

##### Apache

Single domain .htaccess for apache

```
# Set the default charset.
AddDefaultCharset UTF-8

# Don't show directory listings for URLs which map to a directory.
Options -Indexes

# Enable symlinks
Options +FollowSymlinks

# Enable mod_rewrite
RewriteEngine On

# Backend redirect
RewriteCond %{REQUEST_URI} ^/backend
RewriteRule ^backend/(.*)$ backend/web/$1 [L]

# Storage redirect
RewriteCond %{REQUEST_URI} ^/storage
RewriteRule ^storage/(.*)$ storage/$1 [L]

# Frontend redirect
RewriteCond %{REQUEST_URI} ^(.*)$
RewriteRule ^(.*)$ frontend/web/$1
```

### Video instruction

[https://www.youtube.com/watch?v=a8uCGQ25hhg](https://www.youtube.com/watch?v=a8uCGQ25hhg)
