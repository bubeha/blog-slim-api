<?php

declare(strict_types=1);

/** @var \Slim\App $app */
$app->get('/', [\App\Controller\HomeController::class, 'home']);
