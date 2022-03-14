<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Model;

/** @psalm-immutable */
class MethodRunRequest
{
    /** @param mixed[] $params */
    private function __construct(
        private Method $method,
        private array  $params,
    )
    {
    }

    /** @param mixed[] $params */
    public static function create(Method $method, array $params): self
    {
        return new self($method, $params);
    }

    public function getMethod(): Method
    {
        return $this->method;
    }

    /** @return mixed[] */
    public function getParams(): array
    {
        return $this->params;
    }
}