<h2 align="center">Narrowspark Coding Standard</h2>
<h3 align="center">The Narrowspark Coding Standard for is a set of phpstan and php-cs-fixer rules applied to all Narrowspark projects.</h3>

Installation
------------

```bash
composer require narrowspark/coding-standard
```

Use
------------
#### PHPstan
Edit your `phpstan.neon` file and add these rules:

```neon
includes:
    - vendor/pepakriz/phpstan-exception-rules/extension.neon
    - vendor/phpstan/phpstan-deprecation-rules/rules.neon
    - vendor/phpstan/phpstan-phpunit/extension.neon
    - vendor/phpstan/phpstan-phpunit/rules.neon
    - vendor/phpstan/phpstan-strict-rules/rules.neon
    - vendor/thecodingmachine/phpstan-strict-rules/phpstan-strict-rules.neon
```

#### PHP-CS-Fixer
Create a configuration file `.php_cs` in the root of your project:

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

> **Info:**
>
> The used [php-cs-fixer rules](PHP-CS-Fixer-List.md).
>
> For more info, take a look on [php-cs-fixer-config](https://github.com/narrowspark/php-cs-fixer-config).

#### Composer

Then edit your `composer.json` file and add these scripts:

```json
{
  "scripts": {
    "cs": "php-cs-fixer fix",
    "phpstan": "phpstan analyse -c phpstan.neon -l 7 src --memory-limit=-1"
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