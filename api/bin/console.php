<?php

declare(strict_types=1);

use App\Services\Loaders\ConfigLoader;
use Doctrine\Migrations\Tools\Console\Command\DiffCommand;
use Doctrine\Migrations\Tools\Console\Command\ExecuteCommand;
use Doctrine\Migrations\Tools\Console\Command\GenerateCommand;
use Doctrine\Migrations\Tools\Console\Command\LatestCommand;
use Doctrine\Migrations\Tools\Console\Command\ListCommand;
use Doctrine\Migrations\Tools\Console\Command\MigrateCommand;
use Doctrine\Migrations\Tools\Console\Command\StatusCommand;
use Doctrine\Migrations\Tools\Console\Command\UpToDateCommand;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\Command\ValidateSchemaCommand;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Symfony\Component\Console\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$container = require dirname(__DIR__) . '/config/bootstrap.php';

/** @var string $environment */
$environment = env('APP_ENV', 'prod');

// TODO make Console Kernel
(new ConfigLoader([
    dirname(__DIR__) . '/config/packages/*.php',
    dirname(__DIR__) . "/config/packages/{$environment}/*.php",
]))->load($container);

$app = new Application();

$entityManager = $container->get(EntityManagerInterface::class);

$app->getHelperSet()->set(new EntityManagerHelper($entityManager), 'em');

$commands = [
    ValidateSchemaCommand::class,
    ExecuteCommand::class,
    MigrateCommand::class,
    LatestCommand::class,
    ListCommand::class,
    StatusCommand::class,
    UpToDateCommand::class,
    DiffCommand::class,
    GenerateCommand::class,
];

foreach ($commands as $class) {
    /** @var \Symfony\Component\Console\Command\Command $command */
    $command = $container->get($class);
    $app->add($command);
}

$app->run();
