<?php

declare(strict_types=1);

return [
    'debug' => env('APP_DEBUG', false),
    'file' => dirname(__DIR__) . '/../var/logs/app.log',
    'stderr' => true,
];
