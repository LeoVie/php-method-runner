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
        $command = 'php '
            . '-d error_reporting="E_ALL & ~E_ERROR & ~E_WARNING & ~E_NOTICE & ~E_DEPRECATED & ~E_USER_DEPRECATED & ~E_USER_NOTICE" '
            . '-d display_errors=Off '
            . '-f ' . escapeshellarg(\Safe\realpath($filepath));

        $result = shell_exec($command);

        if (!is_string($result)) {
            throw CommandFailed::create($command);
        }

        return $result;
    }
}