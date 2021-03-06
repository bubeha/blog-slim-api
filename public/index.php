<?php

declare(strict_types=1);

use App\Kernel;

/** @var \Psr\Container\ContainerInterface $container */
$container = require dirname(__DIR__) . '/config/bootstrap.php';

$kernel = new Kernel($container);

$kernel->handle();
