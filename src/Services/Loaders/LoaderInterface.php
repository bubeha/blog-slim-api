<?php

declare(strict_types=1);

namespace App\Services\Loaders;

use Slim\App;

interface LoaderInterface
{
    public function load(App $application): void;
}
