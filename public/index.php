<?php

declare(strict_types=1);

use App\Kernel;

$container = require dirname(__DIR__) . '/config/bootstrap.php';

$kernel = new Kernel($container);

$kernel->handle();
