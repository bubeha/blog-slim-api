<?php

declare(strict_types = 1);

use App\Kernel;

/** @psalm-suppress MissingFile */
require __DIR__ . '/../vendor/autoload.php';

$kernel = new Kernel();

$kernel->handle();