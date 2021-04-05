<?php

namespace GCTL;

final class Groups
{
    private static array $groups = [
        'db' => [
            'db',
        ],
        'auth' => [
            'auth'
        ],
        'minimal' => [
            'db', 'auth'
        ],
        'channel' => [
            'ch1',
            'ch2',
            'ch3',
            'ch4',
            'ch99',
        ],
        'all' => [
            'db',
            'auth',
            'ch1',
            'ch2',
            'ch3',
            'ch4',
            'ch99',
        ],
    ];

    public static function All()
    {
        return self::$groups;
    }

    public static function Select(array $selection = ['*'])
    {

    }
}