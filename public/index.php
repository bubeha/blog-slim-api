<?php

declare(strict_types=1);

use App\Kernel;

$container = require dirname(__DIR__) . '/config/bootstrap.php';

(new Kernel($container))
    ->handle()
;
