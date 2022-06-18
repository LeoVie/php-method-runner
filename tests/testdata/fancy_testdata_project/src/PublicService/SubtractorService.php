<?php

declare(strict_types=1);

namespace Foo\FancyTestData\PublicService;

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