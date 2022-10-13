<p align="center">
    <a href="42bs.000webhostapp.com" target="_blank">
    <h1 align="center">42 bike sharing system</h1></a>
    <br>
</p>

This web application is based on yii2!


DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 8.0.2.


INSTALLATION
------------

0. install xampp or mamp your desired php server and mysql
1. clone the repository
2. go to the directory of the project
3. run "composer update"
4. run "php yii serve"



CONFIGURATION
-------------

### Database
create a new database in mysql and import bike_sharing.sql

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=bike_sharing',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```