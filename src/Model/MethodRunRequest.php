<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Model;

class MethodRunRequest
{
    private function __construct(
        private Method $method,
        private array  $params,
    )
    {
    }

    public static function create(Method $method, array $params): self
    {
        return new self($method, $params);
    }

    public function getMethod(): Method
    {
        return $this->method;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}