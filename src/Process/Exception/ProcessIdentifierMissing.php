<?php

namespace GCTL\Process\Exception;

use JetBrains\PhpStorm\Pure;
use Throwable;

final class ProcessIdentifierMissing extends \RuntimeException
{
    #[Pure] public static function fromMissingFile(string $file, ?string $context = null): self
    {
        $context = $context ?? 'unknown';
        return new self("[{$context}] Could not find pid file '{$file}'");
    }
}