<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Model;

/** @psalm-immutable */
class MethodRunRequestWithAutoloading implements MethodRunRequest
{
    /** @param mixed[] $methodParams */
    private function __construct(
        private MethodData $methodData,
        private array      $methodParams,
        private ClassData  $classData,
        private array      $classParams,
        private string     $bootstrapScriptPath,
    )
    {
    }

    /**
     * @param mixed[] $methodParams
     * @param mixed[] $classParams
     */
    public static function create(
        MethodData $methodData,
        array      $methodParams,
        ClassData  $classData,
        array      $classParams,
        string     $bootstrapScriptPath,
    ): MethodRunRequest
    {
        return new self($methodData, $methodParams, $classData, $classParams, $bootstrapScriptPath);
    }

    public function getMethod(): MethodData
    {
        return $this->methodData;
    }

    /** @return mixed[] */
    public function getMethodParams(): array
    {
        return $this->methodParams;
    }

    public function getClass(): ClassData
    {
        return $this->classData;
    }

    /** @return mixed[] */
    public function getClassParams(): array
    {
        return $this->classParams;
    }

    public function getBootstrapScriptPath(): string
    {
        return $this->bootstrapScriptPath;
    }
}