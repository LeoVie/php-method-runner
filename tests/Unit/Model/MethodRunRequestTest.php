<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Tests\Unit\Model;

use LeoVie\PhpMethodRunner\Model\MethodData;
use LeoVie\PhpMethodRunner\Model\MethodRunRequest;
use LeoVie\PhpMethodRunner\Model\MethodRunRequestWithoutAutoloading;
use PHPUnit\Framework\TestCase;

class MethodRunRequestTest extends TestCase
{
    /** @dataProvider getMethodProvider */
    public function testGetMethod(MethodData $expected, MethodRunRequest $methodRunRequest): void
    {
        self::assertSame($expected, $methodRunRequest->getMethod());
    }

    public function getMethodProvider(): \Generator
    {
        $method = MethodData::create('', '');
        yield [
            'expected' => $method,
            MethodRunRequestWithoutAutoloading::create($method, []),
        ];

        $method = MethodData::create('foo', '');
        yield [
            'expected' => $method,
            MethodRunRequestWithoutAutoloading::create($method, []),
        ];
    }

    /** @dataProvider getParamsProvider */
    public function testGetParams(array $expected, MethodRunRequest $methodRunRequest): void
    {
        self::assertSame($expected, $methodRunRequest->getMethodParams());
    }

    public function getParamsProvider(): \Generator
    {
        $params = ['abc', 123];
        yield [
            'expected' => $params,
            MethodRunRequestWithoutAutoloading::create(MethodData::create('', ''), $params),
        ];

        $params = ['abc', 'def', 'ghi'];;
        yield [
            'expected' => $params,
            MethodRunRequestWithoutAutoloading::create(MethodData::create('', ''), $params),
        ];
    }
}