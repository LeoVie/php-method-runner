<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Exception;

use Exception;

class InvalidMethodRunRequest extends Exception
{
    private function __construct(string $class)
    {
        parent::__construct(sprintf('Invalid MethodRunRequest with class "%s"', $class));
    }

    public static function create(string $class): self
    {
        return new self($class);
    }
}