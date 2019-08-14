<?php
declare(strict_types=1);

final class CreatePhpCsFixerList
{
    /**
     * Create the php cs fixer rules md file.
     *
     * @throws \Symfony\Component\VarExporter\Exception\ExceptionInterface
     *
     * @return int
     */
    public static function build(): int
    {
        $rules = (new \Narrowspark\CS\Config\Config())->getRules();

        ksort($rules);

        $content  = '```php';
        $content .= \Symfony\Component\VarExporter\VarExporter::export($rules);
        $content .= '```';

        $return = \file_put_contents(\dirname(__DIR__) . DIRECTORY_SEPARATOR . 'PHP-CS-Fixer-Rules-List-PHP'.(\PHP_VERSION_ID >= 70300 ? '7.3.0' : '7.2.0').'.md', $content);

        return (int) $return;
    }
}
