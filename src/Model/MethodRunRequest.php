<?php
declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Model;

/** @psalm-immutable */
interface MethodRunRequest
{
    public function getMethod(): MethodData;

    /** @return mixed[] */
    public function getMethodParams(): array;
}