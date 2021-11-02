<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Configuration;

class Configuration
{
    private function __construct(private string $generatedDirectory, private string $templateDirectory)
    {
    }

    public static function create(string $generatedDirectory, string $templateDirectory = __DIR__ . '/../../template'): self
    {
        return new self(
            \Safe\realpath(rtrim($generatedDirectory, '/')),
            \Safe\realpath(rtrim($templateDirectory, '/'))
        );
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