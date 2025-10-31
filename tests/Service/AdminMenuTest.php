<?php

declare(strict_types=1);

namespace Tourze\ProductSubscribeBundle\Tests\Service;

use Knp\Menu\ItemInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Tourze\PHPUnitSymfonyWebTest\AbstractEasyAdminMenuTestCase;
use Tourze\ProductSubscribeBundle\Service\AdminMenu;

/**
 * @internal
 */
#[CoversClass(AdminMenu::class)]
#[RunTestsInSeparateProcesses]
class AdminMenuTest extends AbstractEasyAdminMenuTestCase
{
    private AdminMenu $adminMenu;

    protected function onSetUp(): void
    {
        // 父类要求实现此方法
        $this->adminMenu = self::getService(AdminMenu::class);
    }

    public function testAdminMenuCreatesProductMenuWhenNotExists(): void
    {
        $rootItem = $this->createMock(ItemInterface::class);
        $productMenu = $this->createMock(ItemInterface::class);

        $rootItem->expects($this->once())
            ->method('getChild')
            ->with('商品管理')
            ->willReturn(null)
        ;

        $rootItem->expects($this->once())
            ->method('addChild')
            ->with('商品管理', ['icon' => 'fas fa-shopping-cart'])
            ->willReturn($productMenu)
        ;

        $productMenu->expects($this->once())
            ->method('addChild')
            ->with('商品订阅', [
                'route' => 'admin',
                'routeParameters' => [
                    'crudAction' => 'index',
                    'crudControllerFqcn' => 'Tourze\ProductSubscribeBundle\Controller\Admin\ProductSpuSubscribeCrudController',
                ],
            ])
        ;

        ($this->adminMenu)($rootItem);
    }

    public function testAdminMenuUsesExistingProductMenu(): void
    {
        $rootItem = $this->createMock(ItemInterface::class);
        $existingProductMenu = $this->createMock(ItemInterface::class);

        $rootItem->expects($this->once())
            ->method('getChild')
            ->with('商品管理')
            ->willReturn($existingProductMenu)
        ;

        $rootItem->expects($this->never())
            ->method('addChild')
        ;

        $existingProductMenu->expects($this->once())
            ->method('addChild')
            ->with('商品订阅', [
                'route' => 'admin',
                'routeParameters' => [
                    'crudAction' => 'index',
                    'crudControllerFqcn' => 'Tourze\ProductSubscribeBundle\Controller\Admin\ProductSpuSubscribeCrudController',
                ],
            ])
        ;

        ($this->adminMenu)($rootItem);
    }
}
