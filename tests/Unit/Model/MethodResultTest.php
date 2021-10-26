<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Tests\Unit\Model;

use LeoVie\PhpMethodRunner\Model\MethodResult;
use PHPUnit\Framework\TestCase;

class MethodResultTest extends TestCase
{
    /** @dataProvider getResultProvider */
    public function testGetResult(mixed $expected, MethodResult $methodResult): void
    {
        self::assertSame($expected, $methodResult->getResult());
    }

    public function getResultProvider(): array
    {
        return [
            [
                'expected' => 'abc',
                'method' => MethodResult::create('abc'),
            ],
            [
                'expected' => 123,
                'method' => MethodResult::create(123),
            ],
            [
                'expected' => ['abc', 123],
                'method' => MethodResult::create(['abc', 123]),
            ],
        ];
    }
}