<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Tests\Unit\Run;

use LeoVie\PhpMethodRunner\Configuration\Configuration;
use LeoVie\PhpMethodRunner\Generator\PhpFileGenerator;
use LeoVie\PhpMethodRunner\Model\Method;
use LeoVie\PhpMethodRunner\Model\MethodResult;
use LeoVie\PhpMethodRunner\Model\MethodRunRequest;
use LeoVie\PhpMethodRunner\Run\MethodRunner;
use LeoVie\PhpMethodRunner\Run\PhpFileRunner;
use PHPUnit\Framework\TestCase;

class MethodRunnerTest extends TestCase
{
    /** @dataProvider runProvider */
    public function testRun(MethodResult $expected, string $phpFileRunnerResult): void
    {
        $phpFileGenerator = $this->createMock(PhpFileGenerator::class);
        $phpFileGenerator->method('methodFile')->willReturn('');

        $phpFileRunner = $this->createMock(PhpFileRunner::class);
        $phpFileRunner->method('runPhpFile')->willReturn($phpFileRunnerResult);

        self::assertEquals(
            $expected,
            (new MethodRunner($phpFileGenerator, $phpFileRunner))->run(
                MethodRunRequest::create(Method::create('', ''), []),
                Configuration::create('', '')
            ));
    }

    public function runProvider(): \Generator
    {
        yield [
            'expected' => MethodResult::create('abc'),
            'phpFileRunnerResult' => serialize('abc')
        ];

        yield [
            'expected' => MethodResult::create([10, 20, 'abc']),
            'phpFileRunnerResult' => serialize([10, 20, 'abc'])
        ];
    }
}