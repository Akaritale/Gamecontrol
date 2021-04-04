<?php

namespace GCTL\Process\Binary\Runtime;

use GCTL\Process\BinaryLocator;
use GCTL\Process\StatusEnum;
use GCTL\Process\vRunner\Manage;
use Symfony\Component\Process\Process;

abstract class MasterOnly extends Process
{
    /***
     * Set relative path to the runtime if it's not named same as the binary name.
     * @return null|string
     */
    protected static function getAlternativeRuntimePath(): ?string
    {
        return null;
    }

    /***
     * Executable binary name
     * @return string
     */
    abstract protected static function getExecutable(): string;

    /**
     * Returns directory to workspace containing runtimes.
     * @return string
     */
    public static function getWorkspace(): string
    {
        $subDir = static::getAlternativeRuntimePath() ?? static::getExecutable();
        return BinaryLocator::getRootPath($subDir);
    }

    public static function createDemonizedInstance(): self
    {
        return self::runInWorkspace(Manage::RunDaemonCommand(static::getExecutable()));
    }

    public static function createInstance(): self
    {
        return self::runInWorkspace(static::getExecutable());
    }

    public static function Shutdown(): self
    {
        return self::runInWorkspace(Manage::ShutdownDaemonCommand(static::getExecutable()));
    }

    protected static function runInWorkspace(string $command, array $env = null, $input = null, ?float $timeout = 60): self
    {
        return parent::fromShellCommandline("./{$command}", static::getWorkspace(), $env, $input, $timeout);
    }

    public static function fetchPid(): ?int
    {
        $file = static::getWorkspace() . DIRECTORY_SEPARATOR . static::getExecutable() . '.pid';
        if(file_exists($file)) {
            return (int)file_get_contents($file);
        }

        return false;
    }

    public static function ProcessStatus(): string
    {
        $pid = self::fetchPid();
        if($pid === false) {
            return StatusEnum::UNKNOWN;
        }

        if(posix_getpgid($pid) === false) {
            return StatusEnum::RUNNING;
        }

        return StatusEnum::STOPPED;
    }
}