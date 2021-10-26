<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Configuration;

class Configuration
{
    private function __construct(private string $templateDirectory, private string $generatedDirectory)
    {}

    public static function create(string $templateDirectory, string $generatedDirectory): self
    {
        return new self(rtrim($templateDirectory, '/'), rtrim($generatedDirectory, '/'));
    }

    public function getTemplateDirectory(): string
    {
        return $this->templateDirectory;
    }

    public function getGeneratedDirectory(): string
    {
        return $this->generatedDirectory;
    }
}