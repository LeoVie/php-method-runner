<?php

declare(strict_types=1);

namespace Foo\FancyTestData\PrivateService;

class MultiplierService
{
    public function __construct(
        private int $factor
    )
    {
    }

    private function multiply(int $x, int $y): int
    {
        return $this->factor * $x * $y;
    }
}