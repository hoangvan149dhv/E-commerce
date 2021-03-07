Laravel Framework 6.2
==========
## Requirement
- For redSHOP version **>= 2.1.5**: PHP Version: **>= 7.2**
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
install composer: ``https://www.digitalocean.com/community/tutorials/how-to-install-composer-on-ubuntu-20-04-quickstart``

```
$ composer install
```

install nodejs: ``sudo apt install nodejs && sudo apt install npm``

```
$ npm install
```

## Configuration
- Create new file ``.env`` and change
``` bash
 DB_CONNECTION = localhost (apache2), mysqli (docker)  
 DB_HOST = 127.0.0.1
 DB_DATABASE= {your_DB}
 DB_USERNAME= {user_name_DB}
 DB_PASSWORD= {your_pass_DB}
```
## Install data
 Open ``{Your_projecct}/database/backups/{year}/{month}/{day}/{file}.sql`` and install

## Code css/js
{JS}: ``{Your_project}/resources/js/{your_file.js}``
{css}: ``{Your_project}/resources/sass/{your_file.scss}``
Config css in ``webpack.mix.js``: ``mix.sass('{css}','public/frontend/css/{your_file.css}')`` 
Config js in ``webpack.mix.js``: ``mix.js('{js}','public/frontend/js/{your_file.js}')`` 
Run web pack: ``npm run development``

## Contact me
Email: ``hoangvan149dhv@gmail.com``