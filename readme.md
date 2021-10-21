# Médiathèque

Médiathèque est un project donner par la formation Studi en vue du titre de Developpeur Web et Web Mobile.

## Environnement de développement

### Pré-requis

 * PHP 8.0
 * Composer
 * Symfony CLI
 * MySQL
 * XAMMP
### Lancer des tests

```bash
php bin/phpunit --testdox
```

### fixture

Installation

```bash
$ composer require --dev orm-fixtures
```
Utilisation de la bibliothèque PHP Faker pour génèrer de fausses données

```bash
$ composer require fakerphp/faker
```
Documentation de librairie
https://fakerphp.github.io/formatters/file/

Charger les fixtures écrites

```bash
$ php bin/console doctrine:fixtures:load
```
### Utilisation du bundle KnpPaginator

https://symfony.com/doc/current/frontend.html
### Utilisation de WebPackEncore

https://symfony.com/doc/current/frontend.html

### Création du test-coverage 

```bash
$ php bin/phpunit --coverage-html var/log/test/test-coverage
```

## Utilisation de VichUploaderBundle

```bash
$ composer require vich/uploader-bundle
```

### Documentation

Pour la documentation d'utilisation, voir:

https://github.com/dustin10/VichUploaderBundle/blob/master/docs/index.md