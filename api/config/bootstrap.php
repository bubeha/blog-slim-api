<?php

declare(strict_types=1);

use App\Services\Container\Factory;

require dirname(__DIR__) . '/vendor/autoload.php';

return Factory::make(
    require dirname(__DIR__) . '/config/container.php'
);
