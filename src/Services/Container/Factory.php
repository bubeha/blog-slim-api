<?php

declare(strict_types=1);

namespace App\Services\Container;

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

/**
 * Class Builder
 * @package App\Services\Container
 */
class Factory
{
    /**
     * @param array $definitions
     *
     * @return ContainerInterface
     * @throws \Exception
     */
    public static function build(array $definitions = []): ContainerInterface
    {
        $builder = new ContainerBuilder();

        $builder->addDefinitions($definitions);

        return $builder->build();
    }
}
