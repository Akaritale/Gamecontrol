<?php

namespace GCTL\Process\vRunner;

final class Generator
{
    private const PART_BINARY = '1-binary';
    private const PART_DAEMON = '2-daemon';
    private const PART_PID_PATH = '3-pid-path';
    private const PART_FILE = '4-file';
    private const PART_ENV = '5-env';
    private const PART_REDIRECT_OUTPUT = '6-redirect_output';

    private array $parts = [self::PART_BINARY => 'vrunner'];

    public function addPart(string $key, string $value): void
    {
        $this->parts[$key] = $value;
    }

    public function setPart(string $key, string $value): void
    {
        $this->parts[$key] = $value;
    }

    public function removePart(string $key): void
    {
        if(isset($this->parts[$key])) {
            unset($this->parts[$key]);
        }
    }

    public function getCommand(): string
    {
        $parts = ksort($this->parts);

        // Make this possible $env = implode('--env=', $parts[self::PART_ENV]);

        return implode(' ', $parts) . ' 2>&1 &';
    }

    public function RunAsDaemon(bool $runAsDaemon = true): self
    {
        $this->setPart(self::PART_DAEMON, ($runAsDaemon) ? '--daemon' : '');

        return $this;
    }

    public function SavePid(string $fileName): self
    {
        $this->setPart(self::PART_PID_PATH, "--pid={$fileName}");

        return $this;
    }

    public function File(string $fileName): self
    {
        $this->setPart(self::PART_FILE, "--file={$fileName}");

        return $this;
    }

    public function RedirectOutput(string $fileName): self
    {
        $this->setPart(self::PART_REDIRECT_OUTPUT, " >> {$fileName}");

        return $this;
    }

}