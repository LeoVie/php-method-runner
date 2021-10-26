<?php

declare(strict_types=1);

namespace LeoVie\PhpMethodRunner\Run;

use LeoVie\PhpMethodRunner\Exception\CommandFailed;
use Safe\Exceptions\FilesystemException;

class PhpFileRunner
{
    /**
     * @throws FilesystemException
     * @throws CommandFailed
     */
    public function runPhpFile(string $filepath): string
    {
        $command = 'php -f ' . escapeshellarg(\Safe\realpath($filepath));

        $result = shell_exec($command);

        if (!is_string($result)) {
            throw CommandFailed::create($command);
        }

        return $result;
    }
}