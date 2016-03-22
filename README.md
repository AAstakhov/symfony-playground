[![SensioLabsInsight](https://insight.sensiolabs.com/projects/f8f3de80-abd4-4da0-a55b-15f1bc56701c/mini.png)](https://insight.sensiolabs.com/projects/f8f3de80-abd4-4da0-a55b-15f1bc56701c)

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

