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
use Tobento\Service\Resolver\Test\ResolverTest as AbstractResolverTest;
use Tobento\Service\Resolver\ResolverInterface;
use Tobento\Service\ResolverContainer\ResolverFactory;

/**
 * ResolverTest
 */
class ResolverTest extends AbstractResolverTest
{
    protected function createResolver(): ResolverInterface
    {
        return (new ResolverFactory())->createResolver();
    }
}