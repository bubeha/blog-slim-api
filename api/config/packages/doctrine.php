<?php

declare(strict_types=1);

return [
    'dev_mode' => true,
    'cache_dir' => dirname(__DIR__) . '/../var/doctrine',
    'proxy_dir' => dirname(__DIR__) . '/../var/cache/doctrine/proxy',

    'connection' => [
        'driver' => 'pdo_pgsql',
        'host' => env('POSTGRES_HOST'),
        'port' => env('POSTGRES_PORT'),
        'dbname' => env('POSTGRES_DB'),
        'user' => env('POSTGRES_USER'),
        'password' => env('POSTGRES_PASSWORD'),
        'charset' => env('POSTGRES_CHARSET', 'utf-8'),
    ],

    'subscribers' => [],
    'metadata_dirs' => [
        dirname(__DIR__) . '/../src/Entities',
    ],
];
