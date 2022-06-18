<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Run;

use LeoVie\PhpMethodRunner\Configuration\Configuration;
use LeoVie\PhpMethodRunner\Exception\CommandFailed;
use LeoVie\PhpMethodRunner\Generator\PhpFileGenerator;
use LeoVie\PhpMethodRunner\Model\MethodResult;
use LeoVie\PhpMethodRunner\Model\MethodRunRequest;
use LeoVie\PhpMethodRunner\Model\MethodRunRequestWithoutAutoloading;
use Safe\Exceptions\FilesystemException;

class MethodRunner
{
    public function __construct(
        private PhpFileGenerator $phpFileGenerator,
        private PhpFileRunner    $phpFileRunner,
        private Configuration    $configuration
    )
    {
    }

    /**
     * @throws FilesystemException
     * @throws CommandFailed
     */
    public function run(MethodRunRequest $methodRunRequest): MethodResult
    {
        $filepath = $this->phpFileGenerator->methodFile($methodRunRequest, $this->configuration);

        return MethodResult::create(unserialize($this->phpFileRunner->runPhpFile($filepath)));
    }
}