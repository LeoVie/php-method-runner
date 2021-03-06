<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Configuration;

class Configuration
{
    private string $generatedDirectory;
    private string $templateDirectory;

    public function __construct(string $templateDirectory, string $generatedDirectory)
    {
        $this->templateDirectory = \Safe\realpath($templateDirectory);
        $this->generatedDirectory = \Safe\realpath($generatedDirectory);
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