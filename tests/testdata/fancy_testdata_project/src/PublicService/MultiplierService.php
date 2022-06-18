<?php

declare(strict_types=1);

namespace Foo\FancyTestData\Service;

class MultiplierService
{
    public function __construct(
        private int $factor
    )
    {
    }

    public function multiply(int $x, int $y): int
    {
        return $this->factor * $x * $y;
    }
}