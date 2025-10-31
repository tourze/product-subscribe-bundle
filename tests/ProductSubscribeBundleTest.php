<?php

declare(strict_types=1);

namespace Tourze\ProductSubscribeBundle\Tests;

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use EasyCorp\Bundle\EasyAdminBundle\EasyAdminBundle;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Tourze\BundleDependency\BundleDependencyInterface;
use Tourze\DoctrineTimestampBundle\DoctrineTimestampBundle;
use Tourze\EasyAdminExtraBundle\EasyAdminExtraBundle;
use Tourze\EasyAdminMenuBundle\EasyAdminMenuBundle;
use Tourze\PHPUnitBase\TestCaseHelper;
use Tourze\PHPUnitSymfonyKernelTest\AbstractBundleTestCase;
use Tourze\ProductSubscribeBundle\DependencyInjection\ProductSubscribeExtension;
use Tourze\ProductSubscribeBundle\ProductSubscribeBundle;

/**
 * @internal
 */
#[CoversClass(ProductSubscribeBundle::class)]
#[RunTestsInSeparateProcesses]
class ProductSubscribeBundleTest extends AbstractBundleTestCase
{
    public function testGetBundleDependencies(): void
    {
        $dependencies = ProductSubscribeBundle::getBundleDependencies();

        $expectedDependencies = [
            DoctrineBundle::class,
            DoctrineTimestampBundle::class,
            TwigBundle::class,
            EasyAdminBundle::class,
            EasyAdminExtraBundle::class,
            EasyAdminMenuBundle::class,
        ];

        foreach ($expectedDependencies as $expectedBundle) {
            $this->assertArrayHasKey($expectedBundle, $dependencies);
            $this->assertSame(['all' => true], $dependencies[$expectedBundle]);
        }
    }
}
