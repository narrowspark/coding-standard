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

Add the rules manually or use `composer require --dev phpstan/extension-installer`.

If you don’t want to use `phpstan/extension-installer`, include extension.neon in your project’s PHPStan config:

```neon
includes:
    - vendor/narrowspark/coding-standard/base_rules.neon
```

Or

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
    - vendor/slam/phpstan-extensions/conf/slam-rules.neon

parameters:
    level: max
    inferPrivatePropertyTypeFromConstructor: true

    excludes_analyse:
        - vendor

    banned_code:
        # enable detection of `use Tests\Foo\Bar` in a non-test file
        use_from_tests: true
```

Follow the links to check, how to configure the rules:
- https://github.com/phpstan/phpstan-strict-rules
- https://github.com/ekino/phpstan-banned-code

#### PHP-CS-Fixer

Create a configuration file `.php_cs` in the root of your project with this content:

```php
<?php

declare(strict_types=1);

use Ergebnis\License;
use Narrowspark\CS\Config\Config;

$license = License\Type\MIT::markdown(
    __DIR__ . '/LICENSE.md',
    License\Range::since(
        License\Year::fromString('2020'),
        new \DateTimeZone('UTC')
    ),
    License\Holder::fromString('Daniel Bannert'),
    License\Url::fromString('https://github.com/{name}/{repo}')
);

$license->save();

$config = new Config($license->header());
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
> The used [php-cs-fixer rules](docs/PHP-CS-Fixer-Rules-List.md).
>
> For more information, take a look on [php-cs-fixer-config](https://github.com/narrowspark/php-cs-fixer-config).

#### Psalm

Add your config with this command.

```bash
./vendor/bin/psalm --init
```

Now you need to add the `phpunit` and `mockery` plugin to the created `psalm.xml`

```diff
...

+<plugins>
+  <pluginClass class="Psalm\MockeryPlugin\Plugin" />
+  <pluginClass class="Psalm\PhpUnitPlugin\Plugin" />
+</plugins>

...
```

#### Infection
The first time you run Infection for your project, it will ask you questions to create a config file `infection.json.dist`

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
> for more information, take a look on [keepachangelog](https://keepachangelog.com/en/1.0.0/).

#### Rector

Create `rector-src.yaml` and add the configurations to it.

```yaml
imports:
    - { resource: './vendor/thecodingmachine/safe/rector-migrate-0.7.yml' }

parameters:
    php_version_features: '7.2' # change the php version to your used one

    project_type: "open-source"

    sets:
        - 'action-injection-to-constructor-injection'
        - 'array-str-functions-to-static-call'
        - 'celebrity'
        - 'doctrine'
        - 'phpstan'
        - 'solid'
        - 'early-return'
        - 'doctrine-code-quality'
        - 'dead-code'
        - 'code-quality'
        - 'type-declaration'
        - 'php71'
        - 'php72'
#        - 'php73'
#        - 'php74'
```

Create `rector-tests.yaml` and add the configurations to it.

```yaml
parameters:
    php_version_features: '7.2' # change the php version to your used one

    sets:
        - 'celebrity'
        - 'phpstan'
        - 'phpunit-code-quality'
        - 'phpunit-exception'
        - 'phpunit-injector'
        - 'phpunit-specific-method'
        - 'early-return'
        - 'dead-code'
        - 'code-quality'
        - 'type-declaration'
        - 'php71'
        - 'php72'
#        - 'php73'
#        - 'php74'

```

> **Info:**
> for more information about existing sets and setting options, take a look on [rectorphp docs](https://github.com/rectorphp/rector/blob/master/docs/AllRectorsOverview.md).


#### Composer

Then edit your `composer.json` file and add these scripts:

```json
{
  "scripts": {
    "changelog": "changelog-generator generate --config=\"./.changelog\" --file --prepend",
    "cs": "php-cs-fixer fix --config=\"./.php_cs\" --ansi",
    "cs:check": "php-cs-fixer fix --config=\"./.php_cs\" --ansi --dry-run",
    "phpstan": "phpstan analyse -c ./phpstan.neon --ansi",
    "psalm": "psalm --threads=$(nproc)",
    "psalm:fix": "psalm --alter --issues=all --threads=$(nproc) --ansi",
    "infection": "infection --configuration=\"./infection.json\" -j$(nproc) --ansi",
    "rector-src": "rector process ./src/ --config=./rector-src.yaml --ansi --dry-run",
    "rector-src:fix": "rector process ./src/ --config=./rector-src.yaml --ansi",
    "rector-tests": "rector process ./tests/ --config=./rector-tests.yaml --ansi --dry-run",
    "rector-tests:fix": "rector process ./tests/ --config=./rector-tests.yaml --ansi"
  }
}
```

> Tip: if some processes taking longer than the default composer `process-timeout: 300` you can add this to in your composer.json
```jsonp
{
    "config": {
        "process-timeout": 2000 #choose you needed time
    }
}
```

Add `.php_cs.cache` to your `.gitignore` file.

Versioning
------------
This library follows [semantic versioning](https://semver.org/), and additions to the code ruleset are performed in major releases.

Testing
------------

```bash
composer test
```

Contributing
------------

If you would like to help take a look at the [list of issues](https://github.com/narrowspark/coding-standard/issues) and check our [CONTRIBUTING.md](.github/CONTRIBUTING.md) guide.

> **Note:** please note that this project is released with a Contributor Code of Conduct. By participating in this project you agree to abide by its terms.

License
---------------

The Narrowspark Coding Standard is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT)
