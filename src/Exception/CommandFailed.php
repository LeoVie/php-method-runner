<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Exception;

use Exception;

class CommandFailed extends Exception
{
    private function __construct(string $command)
    {
        parent::__construct(\Safe\sprintf('Command did not return a string: "%s"', $command));
    }

    public static function create(string $command): self
    {
        return new self($command);
    }
}