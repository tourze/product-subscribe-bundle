<?php

declare(strict_types=1);

namespace Tourze\ProductSubscribeBundle\Tests\DependencyInjection;

use PHPUnit\Framework\Attributes\CoversClass;
use Tourze\PHPUnitSymfonyUnitTest\AbstractDependencyInjectionExtensionTestCase;
use Tourze\ProductSubscribeBundle\DependencyInjection\ProductSubscribeExtension;

/**
 * @internal
 */
#[CoversClass(ProductSubscribeExtension::class)]
class ProductSubscribeExtensionTest extends AbstractDependencyInjectionExtensionTestCase
{
    protected function createExtension(): ProductSubscribeExtension
    {
        return new ProductSubscribeExtension();
    }

    public function testExtensionIsInstantiable(): void
    {
        $extension = $this->createExtension();
        $this->assertInstanceOf(ProductSubscribeExtension::class, $extension);
    }

    public function testGetConfigDir(): void
    {
        $extension = $this->createExtension();
        $reflectionMethod = new \ReflectionMethod($extension, 'getConfigDir');
        $reflectionMethod->setAccessible(true);

        $configDir = $reflectionMethod->invoke($extension);

        $this->assertStringEndsWith('/Resources/config', $configDir);
        $this->assertDirectoryExists($configDir);
    }
}
