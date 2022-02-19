<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Model;

/** @psalm-immutable */
class MethodResult
{
    private function __construct(private mixed $result)
    {}

    public static function create(mixed $result): self
    {
        return new self($result);
    }

    public function getResult(): mixed
    {
        return $this->result;
    }
}