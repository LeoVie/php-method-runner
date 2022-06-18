<?php

declare(strict_types=1);

namespace Foo\FancyTestData\ProtectedService;

class MultiplierService
{
    public function __construct(
        private int $factor
    )
    {
    }

    protected function multiply(int $x, int $y): int
    {
        return $this->factor * $x * $y;
    }
}