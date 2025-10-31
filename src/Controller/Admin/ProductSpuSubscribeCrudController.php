<?php

namespace Tourze\ProductSubscribeBundle\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminCrud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\NumericFilter;
use Tourze\ProductSubscribeBundle\Entity\SpuSubscribe;

/**
 * @extends AbstractCrudController<SpuSubscribe>
 */
#[AdminCrud(routePath: '/product/spu-subscribe', routeName: 'product_spu_subscribe')]
final class ProductSpuSubscribeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SpuSubscribe::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')->onlyOnIndex(),
            IntegerField::new('goodsId', '商品ID'),
            IntegerField::new('memberId', '用户ID'),
            BooleanField::new('status', '状态'),
            DateTimeField::new('createdAt', '创建时间')->onlyOnIndex(),
            DateTimeField::new('updatedAt', '更新时间')->onlyOnIndex(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('商品订阅')
            ->setEntityLabelInPlural('商品订阅')
            ->setDefaultSort(['id' => 'DESC'])
            ->setPaginatorPageSize(50)
        ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(NumericFilter::new('goodsId', '商品ID'))
            ->add(NumericFilter::new('memberId', '用户ID'))
            ->add(BooleanFilter::new('status', '状态'))
        ;
    }
}
