<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Configuration;

class Configuration
{
    private string $generatedDirectory;
    private string $templateDirectory;

    public function __construct(string $generatedDirectory, string $templateDirectory)
    {
        $this->generatedDirectory = \Safe\realpath(rtrim($generatedDirectory, '/'));
        $this->templateDirectory = \Safe\realpath(rtrim($templateDirectory, '/'));
    }

//    public static function create(string $generatedDirectory, string $templateDirectory = __DIR__ . '/../../template'): self
//    {
//        return new self(
//            \Safe\realpath(rtrim($generatedDirectory, '/')),
//            \Safe\realpath(rtrim($templateDirectory, '/'))
//        );
//    }

    public function getTemplateDirectory(): string
    {
        return $this->templateDirectory;
    }

    public function getGeneratedDirectory(): string
    {
        return $this->generatedDirectory;
    }
}