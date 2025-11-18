<?php

declare(strict_types=1);

namespace Tourze\ProductSubscribeBundle\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Tourze\PHPUnitSymfonyKernelTest\AbstractBundleTestCase;
use Tourze\ProductSubscribeBundle\ProductSubscribeBundle;

/**
 * @internal
 */
#[CoversClass(ProductSubscribeBundle::class)]
#[RunTestsInSeparateProcesses]
class ProductSubscribeBundleTest extends AbstractBundleTestCase
{
}
