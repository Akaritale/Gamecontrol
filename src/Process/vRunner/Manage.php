<?php

namespace GCTL\Process\vRunner;

final class Manage
{
    public static function RunDaemonCommand(string $fileName): string
    {
        return "vrunner --daemon --pid-path=pid.{$fileName} --file={$fileName} >> autorun.log 2>&1 &";
    }

    public static function ShutdownDaemonCommand(string $fileName): string
    {
        return "vrunner --kill --pid-path=pid.{$fileName} >> autorun.log 2>&1";
    }
}