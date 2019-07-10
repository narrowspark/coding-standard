<?php
declare(strict_types=1);

class CreatePhpCsFixerList
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
        $rules    = new \Narrowspark\CS\Config\Config();
        $content  = '```php';
        $content .= \Symfony\Component\VarExporter\VarExporter::export($rules->getRules());
        $content .= '```';

        $return = \file_put_contents(\dirname(__DIR__) . DIRECTORY_SEPARATOR . 'PHP-CS-Fixer-List.md', $content);

        return (int) $return;
    }
}
