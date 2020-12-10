<?php

declare(strict_types = 1);

use Symfony\Component\Console\Application;

/** @psalm-suppress MissingFile */
require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application();

$app->run();
