<?php

declare(strict_types=1);

namespace Tourze\ProductSubscribeBundle\Tests\Repository;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Tourze\PHPUnitSymfonyKernelTest\AbstractRepositoryTestCase;
use Tourze\ProductSubscribeBundle\Entity\SpuSubscribe;
use Tourze\ProductSubscribeBundle\Repository\SpuSubscribeRepository;

/**
 * @internal
 */
#[CoversClass(SpuSubscribeRepository::class)]
#[RunTestsInSeparateProcesses]
final class SpuSubscribeRepositoryTest extends AbstractRepositoryTestCase
{
    protected function createNewEntity(): SpuSubscribe
    {
        $entity = new SpuSubscribe();
        $entity->setGoodsId(random_int(1000, 99999));
        $entity->setMemberId(random_int(1000, 99999));
        $entity->setStatus(false);

        return $entity;
    }

    protected function getRepository(): SpuSubscribeRepository
    {
        return self::getService(SpuSubscribeRepository::class);
    }

    protected function onSetUp(): void
    {
        // 父类要求实现此方法，但我们可以留空
    }

    public function testClearMethod(): void
    {
        $repository = $this->getRepository();
        $entity = $this->createNewEntity();
        $repository->save($entity);

        // 确保实体在管理器中
        $this->assertNotNull($entity->getId());

        // 调用 clear 方法
        $repository->clear();

        // 验证管理器已被清空（通过重新查询验证）
        self::getEntityManager()->clear();
        $detachedEntity = $repository->find($entity->getId());
        $this->assertNotNull($detachedEntity); // 仍然应该在数据库中
    }

    public function testFlushMethod(): void
    {
        $repository = $this->getRepository();
        $entity = $this->createNewEntity();

        // 使用 save 方法但不自动 flush
        $repository->save($entity, false);

        // 手动调用 flush 方法
        $repository->flush();

        // 验证实体已保存
        $this->assertNotNull($entity->getId());
    }

    public function testSaveAllMethod(): void
    {
        $repository = $this->getRepository();

        // 创建多个实体
        /** @var SpuSubscribe[] $entities */
        $entities = [];
        for ($i = 0; $i < 3; ++$i) {
            $entities[] = $this->createNewEntity();
        }

        // 测试批量保存但不立即 flush
        $repository->saveAll($entities, false);

        // 手动 flush
        $repository->flush();

        // 验证所有实体都已保存
        foreach ($entities as $entity) {
            $this->assertNotNull($entity->getId());
        }
    }
}
