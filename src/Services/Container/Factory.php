<?php

declare(strict_types=1);

namespace App\Services\Container;

use DI\ContainerBuilder;
use Exception;
use Psr\Container\ContainerInterface;

/**
 * Class Builder.
 */
final class Factory
{
    /**
     * @throws Exception
     */
    public static function build(array $definitions = []): ContainerInterface
    {
        $builder = new ContainerBuilder();

        $builder->addDefinitions($definitions);

        return $builder->build();
    }
}
