<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Tests\Functional;

use LeoVie\PhpMethodRunner\Configuration\Configuration;
use LeoVie\PhpMethodRunner\Generator\PhpFileGenerator;
use LeoVie\PhpMethodRunner\Model\ClassData;
use LeoVie\PhpMethodRunner\Model\MethodData;
use LeoVie\PhpMethodRunner\Model\MethodResult;
use LeoVie\PhpMethodRunner\Model\MethodRunRequest;
use LeoVie\PhpMethodRunner\Model\MethodRunRequestWithAutoloading;
use LeoVie\PhpMethodRunner\Model\MethodRunRequestWithoutAutoloading;
use LeoVie\PhpMethodRunner\Run\MethodRunner;
use LeoVie\PhpMethodRunner\Run\PhpFileRunner;
use PHPUnit\Framework\TestCase;

class MethodRunnerTest extends TestCase
{
    /** @dataProvider runProvider */
    public function testRun(MethodRunRequest $request, MethodResult $expected): void
    {
        $methodRunner = new MethodRunner(
            new PhpFileGenerator(),
            new PhpFileRunner(),
            new Configuration(
                __DIR__ . '/../../template/',
                __DIR__ . '/../../template/generated/'
            )
        );

        self::assertEquals($expected, $methodRunner->run($request));
    }

    public function runProvider(): array
    {
        return [
            'without autoloading, with method params' => [
                MethodRunRequestWithoutAutoloading::create(
                    MethodData::create(
                        'foo',
                        'function foo(int $x, int $y): int { return $x * $y; }'
                    ),
                    [100, 250]
                ),
                MethodResult::create(25000)
            ],
            'without autoloading, without method params' => [
                MethodRunRequestWithoutAutoloading::create(
                    MethodData::create(
                        'foo',
                        'function foo(): int { return 25000; }'
                    ),
                    []
                ),
                MethodResult::create(25000)
            ],
            'with autoloading, with class params, with method params' => [
                MethodRunRequestWithAutoloading::create(
                    MethodData::create(
                        'multiply',
                        ''
                    ),
                    [100, 250],
                    ClassData::create(
                        '\\Foo\\FancyTestData\\PublicService\\MultiplierService'
                    ),
                    [10],
                    __DIR__ . '/../testdata/fancy_testdata_project/vendor/autoload.php'
                ),
                MethodResult::create(250000),
            ],
            'with autoloading, without class params, with method params' => [
                MethodRunRequestWithAutoloading::create(
                    MethodData::create(
                        'add',
                        ''
                    ),
                    [100, 250],
                    ClassData::create(
                        '\\Foo\\FancyTestData\\PublicService\\AdderService'
                    ),
                    [],
                    __DIR__ . '/../testdata/fancy_testdata_project/vendor/autoload.php'
                ),
                MethodResult::create(350),
            ],
            'with autoloading, with class params, without method params' => [
                MethodRunRequestWithAutoloading::create(
                    MethodData::create(
                        'subtract',
                        ''
                    ),
                    [],
                    ClassData::create(
                        '\\Foo\\FancyTestData\\PublicService\\SubtractorService'
                    ),
                    [250, 100],
                    __DIR__ . '/../testdata/fancy_testdata_project/vendor/autoload.php'
                ),
                MethodResult::create(150),
            ],
            'with autoloading, without class params, without method params' => [
                MethodRunRequestWithAutoloading::create(
                    MethodData::create(
                        'constant',
                        ''
                    ),
                    [],
                    ClassData::create(
                        '\\Foo\\FancyTestData\\PublicService\\ConstantService'
                    ),
                    [],
                    __DIR__ . '/../testdata/fancy_testdata_project/vendor/autoload.php'
                ),
                MethodResult::create(999),
            ],
        ];
    }
}