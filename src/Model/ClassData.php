<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Model;

/** @psalm-immutable */
class ClassData
{
    private function __construct(private string $FQN)
    {}

    public static function create(string $FQN): self
    {
        return new self($FQN);
    }

    public function getFQN(): string
    {
        return $this->FQN;
    }
}