<?php

declare(strict_types=1);

namespace Tourze\ProductSubscribeBundle\Tests\Entity;

use PHPUnit\Framework\Attributes\CoversClass;
use Tourze\PHPUnitDoctrineEntity\AbstractEntityTestCase;
use Tourze\ProductSubscribeBundle\Entity\SpuSubscribe;

/**
 * @internal
 */
#[CoversClass(SpuSubscribe::class)]
final class SpuSubscribeTest extends AbstractEntityTestCase
{
    /**
     * 创建被测实体的实例
     */
    protected function createEntity(): object
    {
        return new SpuSubscribe();
    }

    /**
     * @return array<string, array{string, mixed}>
     */
    public static function propertiesProvider(): array
    {
        return [
            'goodsId' => ['goodsId', 123],
            'memberId' => ['memberId', 456],
            'status1' => ['status', true],
            'status2' => ['status', false],
        ];
    }
}
