<?php

declare(strict_types=1);

namespace Foo\FancyTestData\Service;

class AdderService
{
    public function add(int $x, int $y): int
    {
        return $x + $y;
    }
}