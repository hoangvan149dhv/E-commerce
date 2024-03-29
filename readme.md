<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Laravel  7.x

## Requirement
- PHP Version: **>= 7.2**
## IDE integration
- PHPStorm: https://blog.jetbrains.com/phpstorm/2019/11/phpstorm-2019-3-release#psr

Usage
=====
- Open Terminal/CLI and clone source code. 
```bash
$ git clone https://github.com/hoangvan149dhv/Ecomerce-Laravel.git
```
Installation
============
- Install composer: https://www.digitalocean.com/community/tutorials/how-to-install-composer-on-ubuntu-20-04-quickstart

```
$ composer install
```

- Install nodejs: ``sudo apt install nodejs && sudo apt install npm``

```
$ npm install
```

## Configuration
- Create new file ``.env`` and change
``` bash
 DB_CONNECTION = localhost (Apache2)/mysqli (Docker)  
 DB_HOST = 127.0.0.1/{your_host}
 DB_DATABASE= {your_DB}
 DB_USERNAME= {user_name_DB}
 DB_PASSWORD= {your_pass_DB}
```
## Install data
- Open 
```
{Your_projecct}/database/backups/{year}/{month}/{day}/{file}.sql
``` 
and install

## Code css/js
- {File_JS}: 
```
{Your_project}/resources/js/{your_file.js}
```
- {File_SCSS}: 
```
{Your_project}/resources/sass/{your_file.scss}
```
- Config css in ``webpack.mix.js``: 
```
mix.sass('{File_SCSS}','public/frontend/css/{your_file.css}')
``` 
- Config js in ``webpack.mix.js``: 
```
mix.js('{File_JS}','public/frontend/js/{your_file.js}')
``` 
- Run web pack: 
```
npm run development
```

## Contact me
 Email: ``hoangvan149dhv@gmail.com``
