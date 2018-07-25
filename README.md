<h2 align="center">Narrowspark Coding Standard</h2>
<h3 align="center">The Narrowspark Coding Standard for is a set of phpstan and php-cs-fixer rules applied to all Narrowspark projects.</h3>

Installation
------------

```bash
composer require narrowspark/coding-standard
```

Use
------------
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

Used php-cs-fixer rules:
```php
[
    '@PSR2' => true,
    'align_multiline_comment' => [
        'comment_type' => 'all_multiline',
    ],
    'array_indentation' => true,
    'array_syntax' => [
        'syntax' => 'short',
    ],
    'backtick_to_shell_exec' => true,
    'binary_operator_spaces' => [
        'default' => 'align',
    ],
    'blank_line_after_opening_tag' => false,
    'blank_line_before_return' => true,
    'blank_line_before_statement' => [
        'statements' => [
            0 => 'break',
            1 => 'continue',
            2 => 'declare',
            3 => 'do',
            4 => 'for',
            5 => 'foreach',
            6 => 'if',
            7 => 'include',
            8 => 'include_once',
            9 => 'require',
            10 => 'require_once',
            11 => 'return',
            12 => 'switch',
            13 => 'throw',
            14 => 'try',
            15 => 'while',
            16 => 'yield',
        ],
    ],
    'cast_spaces' => true,
    'class_attributes_separation' => [
        'elements' => [
            0 => 'method',
            1 => 'property',
        ],
    ],
    'class_keyword_remove' => false,
    'combine_consecutive_issets' => true,
    'combine_consecutive_unsets' => true,
    'comment_to_phpdoc' => true,
    'compact_nullable_typehint' => true,
    'concat_space' => [
        'spacing' => 'one',
    ],
    'date_time_immutable' => false,
    'declare_equal_normalize' => true,
    'declare_strict_types' => true,
    'dir_constant' => true,
    'doctrine_annotation_array_assignment' => [
        'operator' => ':',
    ],
    'doctrine_annotation_braces' => [
        'syntax' => 'without_braces',
    ],
    'doctrine_annotation_indentation' => true,
    'doctrine_annotation_spaces' => [
        'after_argument_assignments' => false,
        'after_array_assignments_colon' => true,
        'after_array_assignments_equals' => false,
        'around_parentheses' => true,
        'before_argument_assignments' => false,
        'before_array_assignments_colon' => false,
        'before_array_assignments_equals' => false,
    ],
    'ereg_to_preg' => true,
    'error_suppression' => [
        'mute_deprecation_error' => true,
        'noise_remaining_usages' => false,
    ],
    'escape_implicit_backslashes' => true,
    'explicit_indirect_variable' => true,
    'explicit_string_variable' => true,
    'final_internal_class' => true,
    'fully_qualified_strict_types' => true,
    'function_to_constant' => true,
    'function_typehint_space' => true,
    'general_phpdoc_annotation_remove' => false,
    'hash_to_slash_comment' => true,
    'header_comment' => false,
    'heredoc_to_nowdoc' => true,
    'include' => true,
    'increment_style' => [
        'style' => 'post',
    ],
    'is_null' => true,
    'linebreak_after_opening_tag' => true,
    'list_syntax' => [
        'syntax' => 'short',
    ],
    'logical_operators' => true,
    'lowercase_cast' => true,
    'lowercase_static_reference' => true,
    'magic_constant_casing' => true,
    'mb_str_functions' => true,
    'method_argument_space' => [
        'ensure_fully_multiline' => true,
        'keep_multiple_spaces_after_comma' => false,
    ],
    'method_chaining_indentation' => true,
    'method_separation' => true,
    'modernize_types_casting' => true,
    'multiline_comment_opening_closing' => true,
    'multiline_whitespace_before_semicolons' => [
        'strategy' => 'no_multi_line',
    ],
    'native_constant_invocation' => true,
    'native_function_casing' => true,
    'native_function_invocation' => true,
    'new_with_braces' => true,
    'no_alias_functions' => true,
    'no_alternative_syntax' => true,
    'no_binary_string' => true,
    'no_blank_lines_after_class_opening' => true,
    'no_blank_lines_after_phpdoc' => true,
    'no_blank_lines_before_namespace' => true,
    'no_empty_comment' => true,
    'no_empty_phpdoc' => true,
    'no_empty_statement' => true,
    'no_extra_blank_lines' => [
        'tokens' => [
            0 => 'break',
            1 => 'case',
            2 => 'continue',
            3 => 'curly_brace_block',
            4 => 'default',
            5 => 'extra',
            6 => 'parenthesis_brace_block',
            7 => 'return',
            8 => 'square_brace_block',
            9 => 'switch',
            10 => 'throw',
            11 => 'use',
            12 => 'use_trait',
        ],
    ],
    'no_extra_consecutive_blank_lines' => false,
    'no_homoglyph_names' => false,
    'no_leading_import_slash' => true,
    'no_leading_namespace_whitespace' => true,
    'no_mixed_echo_print' => [
        'use' => 'echo',
    ],
    'no_multiline_whitespace_around_double_arrow' => true,
    'no_multiline_whitespace_before_semicolons' => false,
    'no_null_property_initialization' => true,
    'no_php4_constructor' => false,
    'no_short_bool_cast' => true,
    'no_short_echo_tag' => true,
    'no_singleline_whitespace_before_semicolons' => true,
    'no_spaces_around_offset' => true,
    'no_superfluous_elseif' => true,
    'no_superfluous_phpdoc_tags' => false,
    'no_trailing_comma_in_list_call' => true,
    'no_trailing_comma_in_singleline_array' => true,
    'no_unneeded_control_parentheses' => true,
    'no_unneeded_curly_braces' => true,
    'no_unneeded_final_method' => true,
    'no_unreachable_default_argument_value' => true,
    'no_unset_on_property' => false,
    'no_unused_imports' => true,
    'no_useless_else' => true,
    'no_useless_return' => true,
    'no_whitespace_before_comma_in_array' => true,
    'no_whitespace_in_blank_line' => true,
    'non_printable_character' => true,
    'normalize_index_brace' => true,
    'not_operator_with_space' => false,
    'not_operator_with_successor_space' => true,
    'object_operator_without_whitespace' => true,
    'ordered_class_elements' => true,
    'ordered_imports' => true,
    'php_unit_construct' => true,
    'php_unit_dedicate_assert' => true,
    'php_unit_expectation' => [
        'target' => 'newest',
    ],
    'php_unit_fqcn_annotation' => true,
    'php_unit_internal_class' => [
        'types' => [
            0 => 'abstract',
            1 => 'final',
            2 => 'normal',
        ],
    ],
    'php_unit_mock' => true,
    'php_unit_namespaced' => [
        'target' => 'newest',
    ],
    'php_unit_no_expectation_annotation' => [
        'target' => 'newest',
        'use_class_const' => true,
    ],
    'php_unit_ordered_covers' => true,
    'php_unit_set_up_tear_down_visibility' => true,
    'php_unit_strict' => false,
    'php_unit_test_annotation' => true,
    'php_unit_test_case_static_method_calls' => [
        'call_type' => 'static',
    ],
    'php_unit_test_class_requires_covers' => false,
    'phpdoc_add_missing_param_annotation' => [
        'only_untyped' => false,
    ],
    'phpdoc_align' => true,
    'phpdoc_annotation_without_dot' => true,
    'phpdoc_indent' => true,
    'phpdoc_inline_tag' => true,
    'phpdoc_no_access' => true,
    'phpdoc_no_alias_tag' => true,
    'phpdoc_no_empty_return' => false,
    'phpdoc_no_package' => true,
    'phpdoc_no_useless_inheritdoc' => true,
    'phpdoc_order' => true,
    'phpdoc_return_self_reference' => true,
    'phpdoc_scalar' => true,
    'phpdoc_separation' => true,
    'phpdoc_single_line_var_spacing' => true,
    'phpdoc_summary' => true,
    'phpdoc_to_comment' => false,
    'phpdoc_to_return_type' => true,
    'phpdoc_trim' => true,
    'phpdoc_trim_consecutive_blank_line_separation' => true,
    'phpdoc_types' => true,
    'phpdoc_types_order' => [
        'null_adjustment' => 'always_first',
        'sort_algorithm' => 'alpha',
    ],
    'phpdoc_var_without_name' => true,
    'pow_to_exponentiation' => true,
    'pre_increment' => false,
    'protected_to_private' => true,
    'psr0' => false,
    'psr4' => true,
    'random_api_migration' => true,
    'return_assignment' => true,
    'return_type_declaration' => true,
    'self_accessor' => false,
    'semicolon_after_instruction' => true,
    'set_type_to_cast' => true,
    'short_scalar_cast' => true,
    'silenced_deprecation_error' => false,
    'simplified_null_return' => false,
    'single_blank_line_before_namespace' => false,
    'single_line_comment_style' => false,
    'single_quote' => true,
    'space_after_semicolon' => true,
    'standardize_increment' => true,
    'standardize_not_equals' => true,
    'static_lambda' => false,
    'strict_comparison' => true,
    'strict_param' => true,
    'string_line_ending' => true,
    'ternary_operator_spaces' => true,
    'ternary_to_null_coalescing' => true,
    'trailing_comma_in_multiline_array' => true,
    'trim_array_spaces' => true,
    'unary_operator_spaces' => true,
    'visibility_required' => [
        'elements' => [
            0 => 'const',
            1 => 'method',
            2 => 'property',
        ],
    ],
    'void_return' => false,
    'whitespace_after_comma_in_array' => true,
    'yoda_style' => false,
    '@DoctrineAnnotation' => true,
]
```

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
> **Info:** For more info, take a look on https://github.com/narrowspark/php-cs-fixer-config

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