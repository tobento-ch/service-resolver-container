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

namespace Tobento\Service\ResolverContainer\Test;

use PHPUnit\Framework\TestCase;
use Tobento\Service\Resolver\Test\ResolverFactoryTest as AbstractResolverFactoryTest;
use Tobento\Service\Resolver\ResolverFactoryInterface;
use Tobento\Service\ResolverContainer\ResolverFactory;

/**
 * ResolverFactoryTest
 */
class ResolverFactoryTest extends AbstractResolverFactoryTest
{
    protected function createResolverFactory(): ResolverFactoryInterface
    {
        return new ResolverFactory();
    }
}