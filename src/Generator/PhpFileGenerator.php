<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Generator;

use LeoVie\PhpMethodRunner\Configuration\Configuration;
use LeoVie\PhpMethodRunner\Exception\InvalidMethodRunRequest;
use LeoVie\PhpMethodRunner\Model\MethodRunRequest;
use LeoVie\PhpMethodRunner\Model\MethodRunRequestWithAutoloading;
use LeoVie\PhpMethodRunner\Model\MethodRunRequestWithoutAutoloading;
use Safe\Exceptions\FilesystemException;

class PhpFileGenerator
{
    /**
     * @throws FilesystemException
     * @throws InvalidMethodRunRequest
     */
    public function methodFile(MethodRunRequest $request, Configuration $configuration): string
    {
        return match (true) {
            $request instanceof MethodRunRequestWithoutAutoloading => $this->buildPhpFileWithoutAutoloading($request, $configuration),
            $request instanceof MethodRunRequestWithAutoloading => $this->buildPhpFileWithAutoloading($request, $configuration),
            default => throw InvalidMethodRunRequest::create($request::class),
        };
    }

    /** @throws FilesystemException */
    private function buildPhpFileWithAutoloading(MethodRunRequestWithAutoloading $request, Configuration $configuration): string
    {
        return $this->buildPhpFile(
            $configuration->getTemplateDirectory() . '/run_method_template_with_autoloading.php',
            $configuration->getGeneratedDirectory() . '/run_method.php',
            ['#BOOTSTRAP_SCRIPT#', '#CLASS_NAME#', '#CLASS_PARAMS#', '#FUNCTION_NAME#', '#FUNCTION_PARAMS#'],
            [
                $request->getBootstrapScriptPath(),
                $request->getClass()->getFQN(),
                serialize($request->getClassParams()),
                $request->getMethod()->getName(),
                serialize($request->getMethodParams()),
            ],
        );
    }

    /** @throws FilesystemException */
    private function buildPhpFileWithoutAutoloading(MethodRunRequestWithoutAutoloading $request, Configuration $configuration): string
    {
        return $this->buildPhpFile(
            $configuration->getTemplateDirectory() . '/run_method_template_without_autoloading.php',
            $configuration->getGeneratedDirectory() . '/run_method.php',
            ['#FUNCTION_NAME#', '#FUNCTION_CONTENT#', '#PARAMS#'],
            [
                $request->getMethod()->getName(),
                $request->getMethod()->getContent(),
                serialize($request->getMethodParams()),
            ],
        );
    }

    /**
     * @param string[] $vars
     * @param string[] $varReplacements
     *
     * @throws FilesystemException
     */
    private function buildPhpFile(string $templatePath, string $outputPath, array $vars, array $varReplacements): string
    {
        $runMethodTemplate = \Safe\file_get_contents($templatePath);

        $code = str_replace($vars, $varReplacements, $runMethodTemplate);

        \Safe\file_put_contents($outputPath, $code);

        return $outputPath;
    }
}