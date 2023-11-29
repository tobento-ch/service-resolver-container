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

use Tobento\Service\Resolver\Definition;
use Tobento\Service\Container\DefinitionInterface as ContainerDefinitionInterface;

/**
 * ContainerDefinition
 */
class ContainerDefinition extends Definition implements ContainerDefinitionInterface
{
    /**
     * Set the parameters.
     *
     * @param array<int|string, mixed> $parameters The parameters.
     * @return static $this
     */
    public function with(array $parameters = []): static
    {
        $this->parameters = $parameters;
        
        return $this;
    }
    
    /**
     * Set the parameters.
     *
     * @param mixed ...$parameters The parameters.
     * @return static $this
     */
    public function construct(...$parameters): static
    {
        $this->parameters = $parameters;
        
        return $this;
    }
    
    /**
     * Set a method to call with parameters.
     *
     * @param string $method The name of the method
     * @param array<int|string, mixed> $parameters The parameters.
     * @return static $this
     */
    public function callMethod(string $method, array $parameters = []): static
    {
        $this->methods[] = [$method, $parameters];
        
        return $this;
    }
    
    /**
     * Set if it a prototype, meaning returning always new instance.
     *
     * @param bool $prototype
     * @return static $this
     */
    public function prototype(bool $prototype = true): static
    {
        $this->prototype = $prototype;
        
        return $this;
    }
}