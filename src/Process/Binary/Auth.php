<?php

namespace GCTL\Process\Binary;

use GCTL\Process\Binary\Runtime\MasterOnly;

final class Auth extends MasterOnly
{
    public static function getExecutable(): string
    {
        return 'auth';
    }
}