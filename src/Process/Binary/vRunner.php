<?php

namespace GCTL\Process\Binary;

use GCTL\Process\BinaryLocator;
use GCTL\Process\vRunner\Manage;
use Symfony\Component\Process\Process;

abstract class vRunner extends Process
{
    public static function createFromSettings(string $fileName): vRunner
    {
        $root = BinaryLocator::getBinaryPath();
        $vrunner = Manage::RunDaemonCommand($fileName);

        return self::fromShellCommandline("./{$vrunner}", $root);
    }
}