# Symfony Playground
Set of projects developed on top of Symfony framework to show and test different features, approaches and components.

- [Forms](https://github.com/AAstakhov/symfony-playground/tree/master/forms)

## Install

Install dependencies
```sh
composer install
```

Create the database and the schema for it
```sh
php bin/console doctrine:database:create
php bin/console doctrine:schema:create
```

Run local web server
```sh
php bin/console server:start 127.0.0.1:8080
```

