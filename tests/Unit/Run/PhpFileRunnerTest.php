<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Tests\Unit\Run;

use LeoVie\PhpMethodRunner\Exception\CommandFailed;
use LeoVie\PhpMethodRunner\Run\PhpFileRunner;
use PHPUnit\Framework\TestCase;

class PhpFileRunnerTest extends TestCase
{
    /** @dataProvider runPhpFileProvider */
    public function testRunPhpFile(string $expected, string $filepath): void
    {
        self::assertSame($expected, (new PhpFileRunner())->runPhpFile($filepath));
    }

    public function runPhpFileProvider(): array
    {
        return [
            [
                'expected' => 'hello',
                'filepath' => __DIR__ . '/../../php_files/say_hello.php'
            ],
            [
                'expected' => '{"foo":"bar"}',
                'filepath' => __DIR__ . '/../../php_files/output_json.php'
            ],
        ];
    }

    public function testRunThrows(): void
    {
        self::expectException(CommandFailed::class);

        (new PhpFileRunner())->runPhpFile(__DIR__ . '/../../php_files/do_nothing.php');
    }
}