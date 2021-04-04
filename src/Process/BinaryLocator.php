<?php

namespace GCTL\Process;

use InvalidArgumentException;

final class BinaryLocator
{
    private static ?string $rootPath;
    private static string $binaryPath = 'bin/';

    /**
     * @param string $appendix
     * @return string
     */
    public static function getRootPath(string $appendix = ''): string
    {
        self::$rootPath = getenv('GAME_PATH') ?? getcwd();
        if (!self::$rootPath) {
            throw new InvalidArgumentException('Could not detect root dir, configure GAME_PATH as using environment.');
        }

        return rtrim(self::$rootPath, '\\\/') . DIRECTORY_SEPARATOR . ltrim($appendix, '\\\/');
    }

    /**
     * @return string
     */
    public static function getBinaryPath(): string
    {
        return self::$binaryPath;
    }

    /**
     * @param string $binaryPath
     */
    public static function setBinaryPath(string $binaryPath): void
    {
        self::$binaryPath = $binaryPath;
    }

    public static function getBinaryLocation(?string $binary = null): string
    {
        $dir = self::getRootPath() . DIRECTORY_SEPARATOR . self::getBinaryPath();
        if($binary) {
            $dir .= DIRECTORY_SEPARATOR . $binary;
        }

        return $dir;
    }

    public static function Exists(string $binary, ?string $searchPath = null): bool
    {
        if($searchPath === null) {
            $searchPath = self::getBinaryLocation();
        }

        return is_executable($searchPath . DIRECTORY_SEPARATOR . $binary);
    }

    public static function vRunner(): string
    {
        return self::getBinaryLocation('vrunner');
    }

}