<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Tests\Unit\Generator;

use LeoVie\PhpMethodRunner\Configuration\Configuration;
use LeoVie\PhpMethodRunner\Generator\PhpFileGenerator;
use LeoVie\PhpMethodRunner\Model\Method;
use LeoVie\PhpMethodRunner\Model\MethodRunRequest;
use PHPUnit\Framework\TestCase;

class PhpFileGeneratorTest extends TestCase
{
    /** @dataProvider methodFileProvider */
    public function testMethodFile(string $expected, MethodRunRequest $methodRunRequest, Configuration $configuration): void
    {
        $filepath = (new PhpFileGenerator())->methodFile($methodRunRequest, $configuration);

        self::assertSame($expected, \Safe\file_get_contents($filepath));
    }

    public function methodFileProvider(): \Generator
    {
        $configuration = Configuration::create(__DIR__ . '/../../template', __DIR__ . '/../../template/generated');
        yield [
            'expected' => 'foo:a:2:{i:0;s:3:"bar";i:1;s:3:"bla";}:this is the function',
            MethodRunRequest::create(
                Method::create('foo', 'this is the function'),
                ['bar', 'bla']
            ),
            'configuration' => $configuration,
        ];

        $configuration = Configuration::create(__DIR__ . '/../../template', __DIR__ . '/../../template/generated');
        yield [
            'expected' => 'otherFunction:a:2:{i:0;s:5:"other";i:1;s:6:"params";}:other function content',
            MethodRunRequest::create(
                Method::create('otherFunction', 'other function content'),
                ['other', 'params']
            ),
            'configuration' => $configuration,
        ];
    }
}