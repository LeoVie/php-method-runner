<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Model;

/** @psalm-immutable */
class MethodRunRequestWithoutAutoloading implements MethodRunRequest
{
    /** @param mixed[] $params */
    private function __construct(
        private MethodData $method,
        private array      $params,
    )
    {
    }

    /** @param mixed[] $params */
    public static function create(MethodData $method, array $params): MethodRunRequest
    {
        return new self($method, $params);
    }

    public function getMethod(): MethodData
    {
        return $this->method;
    }

    /** @return mixed[] */
    public function getMethodParams(): array
    {
        return $this->params;
    }
}