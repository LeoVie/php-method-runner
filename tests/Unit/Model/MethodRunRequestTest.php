<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Tests\Unit\Model;

use LeoVie\PhpMethodRunner\Model\Method;
use LeoVie\PhpMethodRunner\Model\MethodRunRequest;
use PHPUnit\Framework\TestCase;

class MethodRunRequestTest extends TestCase
{
    /** @dataProvider getMethodProvider */
    public function testGetMethod(Method $expected, MethodRunRequest $methodRunRequest): void
    {
        self::assertSame($expected, $methodRunRequest->getMethod());
    }

    public function getMethodProvider(): \Generator
    {
        $method = Method::create('', '');
        yield [
            'expected' => $method,
            MethodRunRequest::create($method, []),
        ];

        $method = Method::create('foo', '');
        yield [
            'expected' => $method,
            MethodRunRequest::create($method, []),
        ];
    }

    /** @dataProvider getParamsProvider */
    public function testGetParams(array $expected, MethodRunRequest $methodRunRequest): void
    {
        self::assertSame($expected, $methodRunRequest->getParams());
    }

    public function getParamsProvider(): \Generator
    {
        $params = ['abc', 123];
        yield [
            'expected' => $params,
            MethodRunRequest::create(Method::create('', ''), $params),
        ];

        $params = ['abc', 'def', 'ghi'];;
        yield [
            'expected' => $params,
            MethodRunRequest::create(Method::create('', ''), $params),
        ];
    }
}