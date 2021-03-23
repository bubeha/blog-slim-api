<?php

declare(strict_types=1);

use App\Services\Container\Factory;
use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__) . '/vendor/autoload.php';

if (! class_exists(Dotenv::class)) {
    throw new RuntimeException('"symfony/dotenv" required package');
}

(new Dotenv())
    ->load(appDirectory() . '/.env');

return Factory::build(require appDirectory() . '/config/container.php');
