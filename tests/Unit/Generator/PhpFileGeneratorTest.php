<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Tests\Unit\Generator;

use LeoVie\PhpMethodRunner\Configuration\Configuration;
use LeoVie\PhpMethodRunner\Generator\PhpFileGenerator;
use LeoVie\PhpMethodRunner\Model\ClassData;
use LeoVie\PhpMethodRunner\Model\MethodData;
use LeoVie\PhpMethodRunner\Model\MethodRunRequest;
use LeoVie\PhpMethodRunner\Model\MethodRunRequestWithAutoloading;
use LeoVie\PhpMethodRunner\Model\MethodRunRequestWithoutAutoloading;
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
        $configuration = new Configuration(__DIR__ . '/../../template', __DIR__ . '/../../template/generated');
        yield 'without autoloading #1' => [
            'expected' => 'foo:a:2:{i:0;s:3:"bar";i:1;s:3:"bla";}:this is the function',
            MethodRunRequestWithoutAutoloading::create(
                MethodData::create('foo', 'this is the function'),
                ['bar', 'bla']
            ),
            'configuration' => $configuration,
        ];

        yield 'without autoloading #2' => [
            'expected' => 'otherFunction:a:2:{i:0;s:5:"other";i:1;s:6:"params";}:other function content',
            MethodRunRequestWithoutAutoloading::create(
                MethodData::create('otherFunction', 'other function content'),
                ['other', 'params']
            ),
            'configuration' => $configuration,
        ];

        yield 'with autoloading #1' => [
            'expected' => '/var/www/vendor/autoload.php:\\Foo\\Bar\\FancyClass:a:2:{i:0;i:123;i:1;i:456;}:foo:a:2:{i:0;s:3:"bar";i:1;s:3:"bla";}',
            MethodRunRequestWithAutoloading::create(
                MethodData::create('foo', 'this is the function'),
                ['bar', 'bla'],
                ClassData::create('\\Foo\\Bar\\FancyClass'),
                [123, 456],
                '/var/www/vendor/autoload.php',
            ),
            'configuration' => $configuration,
        ];

        yield 'with autoloading #2' => [
            'expected' => '/project/config/bootstrap.php:\\FancyClass:a:2:{i:0;s:3:"bar";i:1;s:3:"bla";}:foo:a:2:{i:0;i:123;i:1;i:456;}',
            MethodRunRequestWithAutoloading::create(
                MethodData::create('foo', 'this is the function'),
                [123, 456],
                ClassData::create('\\FancyClass'),
                ['bar', 'bla'],
                '/project/config/bootstrap.php',
            ),
            'configuration' => $configuration,
        ];
    }
}