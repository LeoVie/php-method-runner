<?php

declare(strict_types=1);

namespace Foo\FancyTestData\Service;

class SubtractorService
{
    public function __construct(
        private int $x,
        private int $y,
    )
    {
    }

    public function subtract(): int
    {
        return $this->x - $this->y;
    }
}