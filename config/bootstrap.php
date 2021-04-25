<?php

declare(strict_types=1);

use App\Services\Container\Factory;
use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__) . '/vendor/autoload.php';

if (class_exists(Dotenv::class)) {
    (new Dotenv())
        ->load(dirname(__DIR__) . '/.env')
    ;
}

return Factory::make(
    require dirname(__DIR__) . '/config/container.php'
);
