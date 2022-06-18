<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Tests\Unit\Model;

use LeoVie\PhpMethodRunner\Model\MethodData;
use PHPUnit\Framework\TestCase;

class MethodTest extends TestCase
{
    /** @dataProvider getNameProvider */
    public function testGetName(string $expected, MethodData $method): void
    {
        self::assertSame($expected, $method->getName());
    }

    public function getNameProvider(): array
    {
        return [
            [
                'expected' => 'abc',
                'method' => MethodData::create('abc', ''),
            ],
            [
                'expected' => 'fooBar',
                'method' => MethodData::create('fooBar', ''),
            ],
        ];
    }

    /** @dataProvider getContentProvider */
    public function testGetContent(string $expected, MethodData $method): void
    {
        self::assertSame($expected, $method->getContent());
    }

    public function getContentProvider(): array
    {
        return [
            [
                'expected' => 'lorem ipsum',
                'method' => MethodData::create('', 'lorem ipsum'),
            ],
            [
                'expected' => 'dolor sit amet',
                'method' => MethodData::create('', 'dolor sit amet'),
            ],
        ];
    }
}