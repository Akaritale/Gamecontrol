<?php

namespace GCTL;

final class Services
{
    private static array $core = [
        'db' => [
            'label' => 'Database',
            'runtime' => 'db',
        ],
        'auth' => [
            'label' => 'Auth',
            'runtime' => 'auth',
        ],
    ];

    private static array $channels = [
        'ch99' => [
            'label' => 'Channel 99',
            'runtime' => 'game',
            'cores' => [
                'game99',
            ],
        ],
        'ch1' => [
            'label' => 'Channel 1',
            'runtime' => 'game',
            'cores' => [
                'game1',
                'game2',
                'game3',
                'game4',
            ],
        ],
        'ch2' => [
            'label' => 'Channel 2',
            'runtime' => 'game',
            'cores' => [
                'game1',
                'game2',
                'game3',
                'game4',
            ],
        ],
        'ch3' => [
            'label' => 'Channel 3',
            'runtime' => 'game',
            'cores' => [
                'game1',
                'game2',
                'game3',
                'game4',
            ],
        ],
        'ch4' => [
            'label' => 'Channel 4',
            'runtime' => 'game',
            'cores' => [
                'game1',
                'game2',
                'game3',
                'game4',
            ],
        ],
    ];
}