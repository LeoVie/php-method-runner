<?php

declare(strict_types=1);

namespace Foo\FancyTestData\StaticService;

class MultiplierService
{
    public static function multiply(int $x, int $y): int
    {
        return $x * $y;
    }
}