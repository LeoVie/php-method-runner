<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Tests\Unit\Configuration;

use LeoVie\PhpMethodRunner\Configuration\Configuration;
use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{
    /** @dataProvider getTemplateDirectoryProvider */
    public function testGetTemplateDirectory(string $expected, Configuration $configuration): void
    {
        self::assertSame($expected, $configuration->getTemplateDirectory());
    }

    public function getTemplateDirectoryProvider(): array
    {
        return [
            [
                '/var/www/foo',
                Configuration::create('/var/www/foo/', ''),
            ],
            [
                '/var/www/foo',
                Configuration::create('/var/www/foo', ''),
            ],
        ];
    }

    /** @dataProvider getGeneratedDirectoryProvider */
    public function testGetGeneratedDirectory(string $expected, Configuration $configuration): void
    {
        self::assertSame($expected, $configuration->getGeneratedDirectory());
    }

    public function getGeneratedDirectoryProvider(): array
    {
        return [
            [
                '/var/www/foo',
                Configuration::create('', '/var/www/foo/'),
            ],
            [
                '/var/www/foo',
                Configuration::create('', '/var/www/foo'),
            ],
        ];
    }
}