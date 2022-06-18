<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Model;

/** @psalm-immutable */
class MethodData
{
    private function __construct(private string $name, private string $content)
    {}

    public static function create(string $name, string $content): self
    {
        return new self($name, $content);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}