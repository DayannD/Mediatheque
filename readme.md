# Médiathèque

Médiathèque est un project donner par la formation Studi en vue du titre de Developpeur Web et Web Mobile.

## Environnement de développement

### Pré-requis

 * PHP 8.0
 * Composer
 * Symfony CLI
 * MySQL

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