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
use Tobento\Service\Resolver\Test\ResolverPrototypeTest as AbstractResolverPrototypeTest;
use Tobento\Service\Resolver\ResolverInterface;
use Tobento\Service\ResolverContainer\ResolverFactory;

/**
 * ResolverPrototypeTest
 */
class ResolverPrototypeTest extends AbstractResolverPrototypeTest
{
    protected function createResolver(): ResolverInterface
    {
        return (new ResolverFactory())->createResolver();
    }
}