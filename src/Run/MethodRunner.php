<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Run;

use LeoVie\PhpMethodRunner\Configuration\Configuration;
use LeoVie\PhpMethodRunner\Generator\PhpFileGenerator;
use LeoVie\PhpMethodRunner\Model\MethodResult;
use LeoVie\PhpMethodRunner\Model\MethodRunRequest;

class MethodRunner
{
    public function __construct(private PhpFileGenerator $phpFileGenerator, private PhpFileRunner $phpFileRunner)
    {
    }

    public function run(MethodRunRequest $methodRunRequest, Configuration $configuration): MethodResult
    {
        $filepath = $this->phpFileGenerator->methodFile($methodRunRequest, $configuration);

        return MethodResult::create(unserialize($this->phpFileRunner->runPhpFile($filepath)));
    }
}