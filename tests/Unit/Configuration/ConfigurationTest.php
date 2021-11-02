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
                realpath('.'),
                Configuration::create('.', '.'),
            ],
            [
                realpath('.'),
                Configuration::create('.', './'),
            ],
            [
                realpath(__DIR__ . '/../../../template'),
                Configuration::create('.'),
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
                realpath('.'),
                Configuration::create('.'),
            ],
            [
                realpath('.'),
                Configuration::create('./'),
            ],
        ];
    }
}