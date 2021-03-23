<?php

declare(strict_types=1);

return [
    'debug' => env('APP_DEBUG', false),
    'file' => APP_ROOT . '/var/logs/app.log',
    'stderr' => true,
];
