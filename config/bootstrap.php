<?php

declare(strict_types=1);

use App\Services\Container\Factory;
use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__) . '/utils/constants.php';

require APP_ROOT . '/vendor/autoload.php';

if (! class_exists(Dotenv::class)) {
    throw new RuntimeException('"symfony/dotenv" required package');
}

(new Dotenv())
    ->load(APP_ROOT . '/.env');

return Factory::build(require APP_ROOT . '/config/container.php');
