<h2 align="center">Narrowspark Coding Standard</h2>
<h3 align="center">The Narrowspark Coding Standard for all  Narrowspark projects.</h3>

Installation
------------

```bash
composer require narrowspark/coding-standard
```

Use
------------
#### PHPstan

Create a configuration file `phpstan.neon`

Add these rules or use `composer require --dev phpstan/extension-installer`.

The `base_rules.neon` can be used on the `phpstan.neon`, is has some disabled symfony rules.

```neon
includes:
    - vendor/narrowspark/coding-standard/extension.neon
```

or you will do it like this

```neon
includes:
    - vendor/ekino/phpstan-banned-code/extension.neon
    - vendor/phpstan/phpstan-deprecation-rules/rules.neon
    - vendor/phpstan/phpstan-mockery/extension.neon
    - vendor/phpstan/phpstan-phpunit/extension.neon
    - vendor/phpstan/phpstan-phpunit/rules.neon
    - vendor/phpstan/phpstan-strict-rules/rules.neon
    - vendor/phpstan/phpstan/conf/bleedingEdge.neon
    - vendor/thecodingmachine/phpstan-strict-rules/phpstan-strict-rules.neon

parameters:
    level: max
    inferPrivatePropertyTypeFromConstructor: true

    excludes_analyse:
        - vendor
```

Follow the links to check, how to configure some of the rules:
- https://github.com/phpstan/phpstan-strict-rules
- https://github.com/ekino/phpstan-banned-code

#### PHP-CS-Fixer

Create a configuration file `.php_cs` in the root of your project with this content:

```php
<?php
declare(strict_types=1);
use Narrowspark\CS\Config\Config;

$config = new Config();
$config->getFinder()
    ->files()
    ->in(__DIR__ . DIRECTORY_SEPARATOR . 'src')
    ->exclude('build')
    ->exclude('vendor')
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$cacheDir = getenv('TRAVIS') ? getenv('HOME') . '/.php-cs-fixer' : __DIR__;

$config->setCacheFile($cacheDir . '/.php_cs.cache');

return $config;
```

#### psalm

Add your config with this command.

```bash
./vendor/bin/psalm --init
```

> **Info:**
>
> The used [php-cs-fixer rules for php 7.2](PHP-CS-Fixer-Rules-List-PHP7.2.0.md).
>
> The used [php-cs-fixer rules for php 7.3](PHP-CS-Fixer-Rules-List-PHP7.3.0.md).
>
> For more information, take a look on [php-cs-fixer-config](https://github.com/narrowspark/php-cs-fixer-config).

#### Changelog

Create this labels on github `Added`, `Changed`, `Deprecated`, `Removed`, `Fixed`, `Security`

Create a configuration file `.changelog` in the root of your project with this content:

```php
<?php
declare(strict_types=1);

use ChangelogGenerator\ChangelogConfig;

return [
    (new ChangelogConfig(
        '{organisation name}',
        '{repository name}',
        '{your next version}',
        ['Added', 'Changed', 'Deprecated', 'Removed', 'Fixed', 'Security']
    ))
];
```

Create a `CHANGELOG.md` file and put this on the top.

```markdown
# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

```

> **Info:**
> For more information, take a look on [keepachangelog](https://keepachangelog.com/en/1.0.0/).

#### Composer

Then edit your `composer.json` file and add these scripts:

```json
{
  "scripts": {
    "cs": "php-cs-fixer fix",
    "phpstan": "phpstan analyse -c phpstan.neon -l 7 src --memory-limit=-1",
    "psalm": "psalm",
     "changelog":  "changelog-generator generate --config=\".changelog\" --file --append"
  }
}
```

> Tip: if some processes taking longer than the default composer `process-timeout: 300` you can add this to in your composer.json
```jsonp
{
    "config": {
        "process-timeout": 2000 #choose you need time
    }
}
```

Add `.php_cs.cache` to your `.gitignore` file.

Versioning
------------
This library follows semantic versioning, and additions to the code ruleset are only performed in major releases.

Testing
------------

```bash
composer test
```

Contributing
------------

If you would like to help take a look at the [list of issues](http://github.com/narrowspark/coding-standard/issues) and check our [Contributing](CONTRIBUTING.md) guild.

> **Note:** Please note that this project is released with a Contributor Code of Conduct. By participating in this project you agree to abide by its terms.

License
---------------

The Narrowspark Coding Standard is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
