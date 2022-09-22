# Contributing

Contribution are always welcome and much appreciated!

Before starting to contribute, you first need to install dev dependencies:

```bash
composer install --dev
```

Also, in an effort to maintain an homogeneous code base, we strongly encourage contributors
to run [PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) and [PHPStan](https://github.com/phpstan/phpstan)
before submitting a Pull Request.


## Coding standards
Coding standards are enforced using [PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer)

```bash
composer csfixer
```


## Static code analysis
Static code analysis can be achieved using [PHPStan](https://github.com/phpstan/phpstan)

```bash
composer phpstan
```


## Running Tests
By default, test suite is configured to generate a code coverage report in `tests/coverage` folder
(requires [PCOV extension](https://github.com/krakjoe/pcov)).

```bash
composer test
```
