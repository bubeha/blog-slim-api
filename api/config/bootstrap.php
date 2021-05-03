<?php

declare(strict_types=1);

use App\Services\Container\Factory;
use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__) . '/vendor/autoload.php';

return Factory::make(
    require dirname(__DIR__) . '/config/container.php'
);
