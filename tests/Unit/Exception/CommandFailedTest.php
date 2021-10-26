<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Tests\Unit\Exception;

use LeoVie\PhpMethodRunner\Exception\CommandFailed;
use PHPUnit\Framework\TestCase;

class CommandFailedTest extends TestCase
{
    /** @dataProvider createProvider */
    public function testCreate(string $expected, string $command): void
    {
        self::assertSame($expected, CommandFailed::create($command)->getMessage());
    }

    public function createProvider(): array
    {
        return [
            [
                'expected' => 'Command did not return a string: "foo"',
                'command' => 'foo',
            ],
            [
                'expected' => 'Command did not return a string: "this is the command"',
                'command' => 'this is the command',
            ],
        ];
    }
}