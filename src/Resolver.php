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

use Tobento\Service\Container\Container;
use Tobento\Service\Resolver\RuleInterface;
use Tobento\Service\Resolver\OnRule;
use Tobento\Service\Resolver\ResolverInterface;
use Tobento\Service\Resolver\DefinitionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;

/**
 * Resolver
 */
class Resolver implements ResolverInterface, ContainerInterface
{    
    /**
     * Create a new Resolver
     *
     * @param Container $container
     */
    public function __construct(
        protected Container $container,
    ) {}

    /**
     * Sets an entry by its given identifier.
     *
     * @param string $id Identifier of the entry.
     * @param mixed Any value.
     * @return DefinitionInterface
     */
    public function set(string $id, mixed $value = null): DefinitionInterface
    {
        $definition = new ContainerDefinition($id, $value);
        
        $this->container->set($id, $definition);
        
        return $definition;
    }

    /**
     * If an entry by its given identifier exist.
     *
     * @param string $id Identifier of the entry.
     * @return bool Returns true if exist, otherwise false.
     */
    public function has(string $id): bool
    {
        return $this->container->has($id);
    }
    
    /**
     * Gets an entry by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     * @return mixed The value obtained from the identifier.
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    public function get(string $id): mixed
    {        
        return $this->container->get($id);
    }

    /**
     * Makes an entry by its identifier.
     *
     * @param string $id Identifier of the entry.
     * @param array<int|string, mixed> $parameters The parameters.
     * @return mixed The value obtained from the identifier.
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    public function make(string $id, array $parameters = []): mixed
    {
        return $this->container->make($id, $parameters);
    }

    /**
     * Call the given callable.
     *
     * @param mixed $callable A callable.
     * @param array<int|string, mixed> $parameters The parameters.
     * @return mixed The called function result.
     */
    public function call(mixed $callable, array $parameters = []): mixed
    {
        return $this->container->call($callable, $parameters);
    }
    
    /**
     * Add a rule.
     *
     * @param RuleInterface $rule
     * @return RuleInterface
     *
     * @psalm-suppress UndefinedInterfaceMethod
     */
    public function rule(RuleInterface $rule): RuleInterface
    {
        if ($this->container->resolver() instanceof ContainerResolver) {
            $this->container->resolver()->addRule($rule);
        }
        
        return $rule;
    }
    
    /**
     * Resolve on.
     *
     * @param string $id Identifier of the entry.
     * @param mixed Any value.
     * @return OnRule
     *
     * @psalm-suppress UndefinedInterfaceMethod
     */
    public function on(string $id, mixed $value = null): OnRule
    {
        $rule = new OnRule($id, $value);
        
        // we adjust container: Just add a new Resolver for the container.
        if ($this->container->resolver() instanceof ContainerResolver) {
            $this->container->resolver()->addRule($rule);
        }

        return $rule;
    }

    /**
     * Get the container.
     * 
     * @return ContainerInterface
     */
    public function container(): ContainerInterface
    {
        return $this->container;
    }
}