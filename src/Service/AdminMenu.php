<?php

declare(strict_types=1);

namespace Tourze\ProductSubscribeBundle\Service;

use Knp\Menu\ItemInterface;
use Tourze\EasyAdminMenuBundle\Attribute\MenuProvider;
use Tourze\EasyAdminMenuBundle\Service\MenuProviderInterface;

#[MenuProvider]
class AdminMenu implements MenuProviderInterface
{
    public function __invoke(ItemInterface $item): void
    {
        $productMenu = $item->getChild('商品管理');
        if (null === $productMenu) {
            $productMenu = $item->addChild('商品管理', [
                'icon' => 'fas fa-shopping-cart',
            ]);
        }

        $productMenu->addChild('商品订阅', [
            'route' => 'admin',
            'routeParameters' => [
                'crudAction' => 'index',
                'crudControllerFqcn' => 'Tourze\ProductSubscribeBundle\Controller\Admin\ProductSpuSubscribeCrudController',
            ],
        ]);
    }
}
