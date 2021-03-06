<h2 align="center">Narrowspark Coding Standard</h2>
<h3 align="center">The Narrowspark Coding Standard for all  Narrowspark projects.</h3>

Installation
------------

```bash
composer require narrowspark/coding-standard
```

Use
------------
### Settings.yml

Create a configuration file `settings.yml` in `.github`

```yaml
# https://github.com/probot/settings

branches:
  - name: main
    protection:
      enforce_admins: false
      required_pull_request_reviews:
        dismiss_stale_reviews: true
        require_code_owner_reviews: true
        required_approving_review_count: 1
      restrictions:

        # https://developer.github.com/v3/repos/branches/#parameters-1

        # Note: User, app, and team restrictions are only available for organization-owned repositories.
        # Set to null to disable when using this configuration for a repository on a personal account.

        apps: []
        teams: []

labels:
  - name: Added
    description: "Changelog Added"
    color: 90db3f

  - name: Changed
    description: "Changelog Changed"
    color: fbca04

  - name: dependency
    description: "Pull requests that update a dependency file"
    color: e1f788

  - name: Deprecated
    description: "Changelog Deprecated"
    color: 1d76db

  - name: Duplicate
    color: 000000

  - name: Enhancement
    color: d7e102

  - name: Fixed
    description: "Changelog Fixed"
    color: 9ef42e

  - name: Removed
    description: "Changelog Removed"
    color: e99695

  - name: Security
    description: "Changelog Security"
    color: ed3e3b

  - name: "Status: Good first issue"
    color: d7e102

  - name: "Status: Help wanted"
    color: 85d84e

  - name: "Status: Needs Work"
    color: fad8c7

  - name: "Status: Waiting for feedback"
    color: fef2c0

  - name: "Type: BC Break"
    color: b60205

  - name: "Type: Bug"
    color: b60205

  - name: "Type: Critical"
    color: ff8c00

  - name: "Type: RFC"
    color: fbca04

  - name: "Type: Unconfirmed"
    color: 444444

  - name: "Type: Wontfix"
    color: 000000

repository:
  allow_merge_commit: true
  allow_rebase_merge: false
  allow_squash_merge: false
  archived: false
  default_branch: main
  delete_branch_on_merge: true
  # Needs to be added
  description: ""
  has_downloads: true
  has_issues: true
  has_pages: false
  has_projects: false
  has_wiki: false
  # Needs to be added
  name: ""
  private: false

  # https://developer.github.com/v3/repos/branches/#remove-branch-protection
  # Needs to be added
  topics: ""

```

#### PHPstan

Create a configuration file `phpstan.neon` and `phpstan-baseline.neon`.

```neon
includes:
    - vendor/narrowspark/coding-standard/base_rules.neon
    - vendor/phpstan/phpstan/conf/bleedingEdge.neon
    - %currentWorkingDirectory%/phpstan-baseline.neon

parameters:
    level: max
    inferPrivatePropertyTypeFromConstructor: true

    paths:
        -  %currentWorkingDirectory%/src
        -  %currentWorkingDirectory%/tests

    tmpDir: %currentWorkingDirectory%/.build/phpstan

    excludes_analyse:
        - vendor
```

Follow the links to check, how to configure the rules:
- https://github.com/phpstan/phpstan-strict-rules
- https://github.com/symplify/phpstan-rules

The Narrowspark PHPstan rules providing configurations for `symplify/phpstan-rules`.

Default configurations:
```neon
parameters:
    symplify:
        no_chain_method_call:
            allowed_chain_types:
                - Mockery
                - Mockery\MockInterface
                - Mockery\ExpectationInterface
                - Mockery\Expectation
                - Mockery\HigherOrderMessage
        prevent_duplicate_class_method:
            minimum_line_count: 4
        no_short_name:
            min_name_length: 2
        forbidden_complex_func_call:
            forbidden_complex_functions:
                - 'array_filter'
            maximum_stmt_count: 2
        forbidden_node:
            forbidden_nodes:
                - PhpParser\Node\Expr\Empty_
                - PhpParser\Node\Stmt\Switch_
                - PhpParser\Node\Expr\ErrorSuppress
        forbidden_func_call:
            forbidden_functions:
                - 'd'
                - 'dd'
                - 'dump'
                - 'var_dump'
                - 'extract'
                - 'curl_*'
                - 'compact'
                - 'method_exists'
                - 'property_exists'
                - 'spl_autoload_register'
                - 'spl_autoload_unregister'
                - array_walk
        see_annotation_to_test:
            required_see_types:
                - PHPStan\Rules\Rule
        class_name_respects_parent_suffix:
            parent_classes:
                - Symfony\Component\Console\Command\Command
        too_long_variable:
            max_variable_length: 10
```

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
        License\Year::fromString('2021'),
        new \DateTimeZone('UTC')
    ),
    License\Holder::fromString('Daniel Bannert'),
    License\Url::fromString('https://github.com/{name}/{repo}')
);

$license->save();

$config = new Config($license->header());
$config->getFinder()
    ->files()
    ->in(__DIR__)
    ->exclude([
        '.build',
        '.docker',
        '.github',
        'vendor'
    ])
    // php_unit_namespaced rule thinks than the const are some namespaces
    ->notPath('rector.php')
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$config->setCacheFile(__DIR__ . '/.build/php-cs-fixer/.php_cs.cache');

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

Or use our configuration

```xml
<?xml version="1.0"?>
<psalm
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xmlns="https://getpsalm.org/schema/config"
    xsi:schemaLocation="https://getpsalm.org/schema/config/vendor/vimeo/psalm/config.xsd"
    cacheDirectory="./.build/psalm"
    errorBaseline="psalm-baseline.xml"
    resolveFromConfigFile="true"
    allowStringToStandInForClass='true'
    findUnusedCode='true'
    findUnusedVariablesAndParams='true'
    strictBinaryOperands='true'
    totallyTyped='true'
    usePhpDocMethodsWithoutMagicCall='true'
    phpVersion='8.0'
    errorLevel='8'
>
    <issueHandlers>
        <LessSpecificReturnType errorLevel="info" />
    </issueHandlers>

    <plugins>
        <pluginClass class="Psalm\PhpUnitPlugin\Plugin" />
    </plugins>

    <projectFiles>
        <directory name="src" />
        <directory name="tests" />
        <ignoreFiles>
            <directory name="vendor" />
            <directory name=".build" />
            <directory name=".docker" />
            <directory name=".github" />
        </ignoreFiles>
    </projectFiles>

    <issueHandlers>
        <PossiblyUndefinedIntArrayOffset errorLevel="error" />
        <PossiblyUndefinedStringArrayOffset errorLevel="error" />
    </issueHandlers>
</psalm>
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

#### Rector

Create `rector.php` and add the configurations to it.

```php
<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021 Daniel Bannert
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/narrowspark/php-cs-fixer-config
 */

use Rector\Core\Configuration\Option;
use Rector\Core\ValueObject\PhpVersion;
use Rector\PHPUnit\Set\PHPUnitSetList;
use Rector\Set\ValueObject\SetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    // paths to refactor; solid alternative to CLI arguments
    $parameters->set(Option::PATHS, [__DIR__ . '/src', __DIR__ . '/tests']);

    // is your PHP version different from the one your refactor to? [default: your PHP version], uses PHP_VERSION_ID format
    $parameters->set(Option::PHP_VERSION_FEATURES, PhpVersion::PHP_80);

    // auto import fully qualified class names? [default: false]
    $parameters->set(Option::AUTO_IMPORT_NAMES, true);

    // skip root namespace classes, like \DateTime or \Exception [default: true]
    $parameters->set(Option::IMPORT_SHORT_CLASSES, false);

    // skip classes used in PHP DocBlocks, like in /** @var \Some\Class */ [default: true]
    $parameters->set(Option::IMPORT_DOC_BLOCKS, false);

    // Run Rector only on changed files
    $parameters->set(Option::ENABLE_CACHE, true);

    $phpstanPath = getcwd() . '/phpstan.neon';
    $phpstanNeonContent = FileSystem::read($phpstanPath);
    $bleedingEdgePattern = '#\n\s+-(.*?)bleedingEdge\.neon[\'|"]?#';

    // bleeding edge clean out, see https://github.com/rectorphp/rector/issues/2431
    if (Strings::match($phpstanNeonContent, $bleedingEdgePattern)) {
        $temporaryPhpstanNeon = getcwd() . '/rector-temp-phpstan.neon';
        $clearedPhpstanNeonContent = Strings::replace($phpstanNeonContent, $bleedingEdgePattern);

        FileSystem::write($temporaryPhpstanNeon, $clearedPhpstanNeonContent);

        $phpstanPath = $temporaryPhpstanNeon;
    }

    // Path to phpstan with extensions, that PHPStan in Rector uses to determine types
    $parameters->set(Option::PHPSTAN_FOR_RECTOR_PATH, $phpstanPath);

    $parameters->set(Option::SETS, [
        SetList::CODING_STYLE,
        SetList::CODE_QUALITY,
        SetList::CODE_QUALITY_STRICT,
        SetList::DEAD_CODE,
        SetList::PRIVATIZATION,
        SetList::NAMING,
        SetList::TYPE_DECLARATION,
        SetList::ORDER,
        SetList::PHP_71,
        SetList::PHP_72,
        SetList::PHP_73,
        SetList::PHP_74,
        SetList::PHP_80,
        SetList::EARLY_RETURN,
        SetList::TYPE_DECLARATION_STRICT,
        SetList::PSR_4,
        // SetList::SAFE_07, enable if https://github.com/thecodingmachine/safe is used
        PHPUnitSetList::PHPUNIT_CODE_QUALITY,
        PHPUnitSetList::PHPUNIT_91,
        PHPUnitSetList::PHPUNIT_EXCEPTION,
        PHPUnitSetList::PHPUNIT_YIELD_DATA_PROVIDER,
        PHPUnitSetList::PHPUNIT_SPECIFIC_METHOD,
    ]);
};
```

> **Info:**
> for more information about existing sets and setting options, take a look on [rectorphp docs](https://github.com/rectorphp/rector/blob/master/docs/AllRectorsOverview.md).


#### Composer

Then edit your `composer.json` file and add these scripts:

```json
{
    "scripts": {
        "cs": "php-cs-fixer fix --config=\"./.php_cs\" --ansi",
        "cs:check": "php-cs-fixer fix --config=\"./.php_cs\" --ansi --dry-run",
        "infection": "XDEBUG_MODE=coverage infection --configuration=\"./infection.json\" -j$(nproc) --ansi",
        "phpstan": "phpstan analyse -c ./phpstan.neon --ansi --memory-limit=-1",
        "phpstan:baseline": "phpstan analyse -c ./phpstan.neon --ansi --generate-baseline --memory-limit=-1",
        "psalm": "psalm --threads=$(nproc)",
        "psalm:fix": "psalm --alter --issues=all --threads=$(nproc)",
        "rector": "rector process --ansi --dry-run",
        "rector:fix": "rector process --ansi",
        "test": "phpunit",
        "test:coverage": "phpunit --coverage-html=./.build/phpunit/coverage"
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
