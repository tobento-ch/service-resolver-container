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

use Tobento\Service\Container\Resolver;
use Tobento\Service\Container\DefinitionInterface;
use Tobento\Service\Container\ResolverException;
use Tobento\Service\Resolver\RuleInterface;
use Closure;

/**
 * ContainerResolver
 */
class ContainerResolver extends Resolver
{
    /**
     * @var array<int, RuleInterface> The rules.
     */    
    protected array $rules = [];
    
    /**
     * @var null|RuleInterface
     */    
    protected null|RuleInterface $lastRule = null;    
    
    /**
     * Resolve the given identifier to a value.
     *
     * @param string $id Identifier of the entry.
     * @param array<int|string, mixed> $parameters
     *
     * @throws ResolverException
     *
     * @return mixed
     */
    public function resolve(string $id, array $parameters = []): mixed
    {
        return $this->handleRules(parent::resolve($id, $parameters), $id);
    }
    
    /**
     * Resolve the given definition.
     *
     * @param DefinitionInterface $definition
     *
     * @return mixed The value of the resolved definition.
     */
    public function resolveDefinition(DefinitionInterface $definition): mixed
    {
        $value = $definition->getValue() ?: $definition->getId();
        
        if (!empty($definition->getParameters()))
        {                
            if (is_string($value)) {
                $value = $this->resolve($value, $definition->getParameters());
            }
        }     
                
        // Resolve value if it is resolvable
        if (is_string($value) && $this->isResolvable($value))
        {
            $value = $this->resolve($value);
        }

        // Handle closure definition.
        if ($value instanceof Closure)
        {
            $value = $value($this->container);
        }
        
        // Handle method calls.
        if (is_object($value))
        {
            $value = $this->handleRules($value, $definition->getId());
            
            if (!empty($definition->getMethods()))
            {
                $value = $this->callMethods($value, $definition);
            }
        }

        return $value;        
    }
    
    /**
     * Adds a rule.
     *
     * @param RuleInterface $rule
     * @return void
     */
    public function addRule(RuleInterface $rule): void
    {
        if (is_null($this->lastRule)) {
            $this->lastRule = $rule;
        } else {
            $this->rules[$this->lastRule->getPriority()][] = $this->lastRule;
            $this->lastRule = $rule;
            krsort($this->rules);            
        }      
    }
    
    /**
     * Handle the rules.
     *
     * @param object $object
     * @param null|string $entryId
     * @return object
     */
    public function handleRules(object $object, null|string $entryId = null): object
    {
        if (!is_null($this->lastRule)) {
            $this->addRule($this->lastRule);
            $this->lastRule = null;
        }
            
        if (empty($this->rules)) {
            return $object;
        }
        
        foreach($this->rules as $priority => $rules)
        {            
            foreach($rules as $index => $rule)
            {
                $object = $rule->handle($object, $entryId, $this->container);
                
                if ($rule->isDone()) {
                    unset($this->rules[$priority][$index]);
                }
            }
        }

        return $object;
    }    
}