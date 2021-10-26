<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Tests\Unit\Model;

use LeoVie\PhpMethodRunner\Model\Method;
use PHPUnit\Framework\TestCase;

class MethodTest extends TestCase
{
    /** @dataProvider getNameProvider */
    public function testGetName(string $expected, Method $method): void
    {
        self::assertSame($expected, $method->getName());
    }

    public function getNameProvider(): array
    {
        return [
            [
                'expected' => 'abc',
                'method' => Method::create('abc', ''),
            ],
            [
                'expected' => 'fooBar',
                'method' => Method::create('fooBar', ''),
            ],
        ];
    }

    /** @dataProvider getContentProvider */
    public function testGetContent(string $expected, Method $method): void
    {
        self::assertSame($expected, $method->getContent());
    }

    public function getContentProvider(): array
    {
        return [
            [
                'expected' => 'lorem ipsum',
                'method' => Method::create('', 'lorem ipsum'),
            ],
            [
                'expected' => 'dolor sit amet',
                'method' => Method::create('', 'dolor sit amet'),
            ],
        ];
    }
}