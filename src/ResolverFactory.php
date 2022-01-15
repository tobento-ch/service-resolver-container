<?php

/**
 * TOBENTO
 *
 * @copyright   Tobias Strub, TOBENTO
 * @license     MIT License, see LICENSE file distributed with this source code.
 * @author      Tobias Strub
 * @link        https://www.tobento.ch
 */

declare(strict_types=1);

namespace Tobento\Service\ResolverContainer;

use Tobento\Service\Resolver\ResolverFactoryInterface;
use Tobento\Service\Resolver\ResolverInterface;
use Tobento\Service\ResolverContainer\ContainerResolver;
use Tobento\Service\Container\Container;

/**
 * ResolverFactory
 */
class ResolverFactory implements ResolverFactoryInterface
{
    /**
     * Create a new Resolver.
     *
     * @return ResolverInterface
     */
    public function createResolver(): ResolverInterface
    {
        $container = new Container();
        
        $container->setResolver(new ContainerResolver($container));
        
        return new Resolver($container);
    }
}