<?php

namespace Tourze\ProductSubscribeBundle\DataFixtures;

use Carbon\CarbonImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\Attribute\When;
use Tourze\ProductSubscribeBundle\Entity\SpuSubscribe;

#[When(env: 'test')]
#[When(env: 'dev')]
final class SpuSubscribeFixtures extends Fixture
{
    public const TEST_SPU_SUBSCRIBE_REFERENCE = 'test-spu-subscribe';

    public function load(ObjectManager $manager): void
    {
        $spuSubscribe = new SpuSubscribe();
        $spuSubscribe->setGoodsId(1);
        $spuSubscribe->setMemberId(1);
        $spuSubscribe->setStatus(true);
        $spuSubscribe->setCreateTime(CarbonImmutable::now());
        $spuSubscribe->setUpdateTime(CarbonImmutable::now());

        $manager->persist($spuSubscribe);
        $this->addReference(self::TEST_SPU_SUBSCRIBE_REFERENCE, $spuSubscribe);

        $manager->flush();
    }
}
