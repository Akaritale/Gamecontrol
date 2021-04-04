<?php

namespace GCTL\Process\Binary;

use GCTL\Process\Binary\Runtime\MasterOnly;

final class DB extends MasterOnly
{
    public static function getExecutable(): string
    {
        return 'db';
    }
}