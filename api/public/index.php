<?php

declare(strict_types=1);

use App\Kernel;

$container = require dirname(__DIR__) . '/config/bootstrap.php';

/** @var string $environment */
$environment = env('APP_ENV', 'prod');

(new Kernel($environment, $container))
    ->handle()
;
