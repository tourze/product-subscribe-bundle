<?php

namespace Tourze\ProductSubscribeBundle\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Tourze\DoctrineTimestampBundle\Traits\TimestampableAware;

/**
 * 商品申请表
 */
#[ORM\Table(name: 'ims_goods_subscribe', options: ['comment' => '商品申请表'])]
#[ORM\UniqueConstraint(name: 'goods_subscribe_idx_unique', columns: ['goods_id', 'member_id'])]
#[ORM\Entity]
class SpuSubscribe implements \Stringable
{
    use TimestampableAware;

    #[Groups(groups: ['restful_read', 'api_tree', 'admin_curd', 'api_list'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER, options: ['comment' => 'ID'])]
    private int $id = 0;

    #[Groups(groups: ['restful_read', 'admin_curd'])]
    #[Assert\PositiveOrZero(message: '商品ID必须为非负整数')]
    #[ORM\Column(type: Types::INTEGER, nullable: false, options: ['comment' => '商品ID'])]
    private int $goodsId;

    #[Assert\PositiveOrZero(message: '用户ID必须为非负整数')]
    #[ORM\Column(type: Types::INTEGER, nullable: false, options: ['comment' => '用户'])]
    private int $memberId;

    #[Assert\Type(type: 'bool', message: '状态必须为布尔值')]
    #[ORM\Column(type: Types::BOOLEAN, nullable: false, options: ['default' => '0', 'comment' => '状态'])]
    private bool $status = false;

    public function getId(): int
    {
        return $this->id;
    }

    public function getGoodsId(): int
    {
        return $this->goodsId;
    }

    public function setGoodsId(int $goodsId): void
    {
        $this->goodsId = $goodsId;
    }

    public function getMemberId(): int
    {
        return $this->memberId;
    }

    public function setMemberId(int $memberId): void
    {
        $this->memberId = $memberId;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    public function __toString(): string
    {
        return (string) $this->getId();
    }
}
