<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Generator;

use LeoVie\PhpMethodRunner\Configuration\Configuration;
use LeoVie\PhpMethodRunner\Model\MethodRunRequest;
use Safe\Exceptions\FilesystemException;

class PhpFileGenerator
{
    /** @throws FilesystemException */
    public function methodFile(MethodRunRequest $request, Configuration $configuration): string
    {
        return $this->buildPhpFile(
            $configuration->getTemplateDirectory() . '/run_method_template.php',
            $configuration->getGeneratedDirectory() . '/run_method.php',
            ['#FUNCTION_NAME#', '#FUNCTION_CONTENT#', '#PARAMS#'],
            [
                $request->getMethod()->getName(),
                $request->getMethod()->getContent(),
                serialize($request->getParams()),
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