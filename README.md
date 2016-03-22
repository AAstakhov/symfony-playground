# Symfony Playground
Set of projects developed on top of Symfony framework to show and test different features, approaches and components.

- [Forms](https://github.com/AAstakhov/symfony-playground/tree/master/forms)

## Install

1. Install dependencies
```
composer install
```

2. Create the database and the schema for it
```
php bin/console doctrine:database:create
php bin/console doctrine:schema:create
```

3. Run local web server
```
php bin/console server:start 127.0.0.1:8080
```

