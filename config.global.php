<?php

return [
    'debug' => false,

    'datetime' => [
        'timezone' => 'Europe/Stockholm',
    ],

    'views' => [
        'path'       => __DIR__ . '/views',
        'extension'  => 'php',
        'extensions' => [
            'App\Views\ViewExtension'
        ],
    ],

    'providers' => [
        'Enstart\ServiceProvider\ServiceProvider',
        'App\Providers\AppProvider',
    ],

    'auth' => [
        'username' => 'Change me in your local config',
        'password' => 'Change me in your local config',
    ],

    'data' => [
        'content' => __DIR__ . '/storage/content',
        'db'      => __DIR__ . '/storage/db',
    ],

    'logging' => [
        'name'  => 'api',
        'level' => 'error',
        'file'  => __DIR__ . '/storage/logs/' . date('Ymd') . '.log',
    ],

    'commands' => [
        'App\Commands\HelloWorldCommand',
    ],
];
