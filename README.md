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

## Planned Playground Projects
- Forms: data transformers, form events, form type extensions
- Security: firewalls, Guard, access control rules, voters (idea: random vote)
- Controller: file upload
- Routing: Conditional request matching
- Translations and pluralization, string interpolation, assets management
- DI: factories, autowiring, configurator(!), expressions in service config
- Bundle configuration: ConfigurableExtension 
- Controllers: bundle inheritance
- Console events

### Later (after certification) 
- Expression language 
 - not needed for certification
 - maybe with forms
 - see https://www.symfony.fi/entry/its-time-to-get-creative-with-the-symfony-expression-language)
- Microframework
