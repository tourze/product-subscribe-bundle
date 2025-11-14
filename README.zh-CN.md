# 产品订阅 Bundle

[English](README.md) | [中文](README.zh-CN.md)

一个用于管理产品订阅功能的 Symfony Bundle，提供完整的管理界面和强大的仓库管理功能。

## 功能特性

- **产品订阅实体管理**，支持完整的 CRUD 操作
- **管理界面**与 EasyAdmin 集成，提供无缝管理体验
- **仓库模式实现**，遵循最佳实践
- **时间戳跟踪**，自动管理订阅记录的创建和更新时间
- **用户和产品关系管理**，具备完善的索引优化
- **数据库迁移**，简化部署和设置过程
- **全面的测试覆盖**，确保可靠性

## 安装

### 系统要求

- PHP 8.1+
- Symfony 7.3+
- Doctrine ORM 3.0+
- EasyAdmin Bundle 4+

### Composer 安装

将 bundle 添加到您的 `composer.json`：

```bash
composer require tourze/product-subscribe-bundle
```

### Bundle 注册

在 `config/bundles.php` 中注册 bundle：

```php
<?php

return [
    // ...
    Tourze\ProductSubscribeBundle\ProductSubscribeBundle::class => ['all' => true],
];
```

## 配置

### 数据库架构

运行迁移来创建订阅表：

```bash
php bin/console doctrine:migrations:migrate
```

Bundle 会创建 `ims_goods_subscribe` 表，包含以下结构：

| 字段 | 类型 | 描述 |
|------|------|------|
| `id` | bigint | 主键（自增） |
| `goods_id` | bigint | 产品标识符（已索引） |
| `member_id` | bigint | 用户标识符（已索引） |
| `status` | boolean | 订阅状态（激活/非激活） |
| `created_at` | datetime | 创建时间戳 |
| `updated_at` | datetime | 最后更新时间戳 |

### 管理界面

Bundle 提供位于 `/admin/product/spu-subscribe` 的管理界面，具备：

- **列表视图**，支持按产品 ID、用户 ID 和状态筛选
- **创建/编辑表单**，用于管理订阅
- **分页功能**（每页 50 条记录）
- **排序功能**（默认按 ID 降序）
- **搜索功能**，覆盖所有主要字段

## 使用方法

### 实体使用

`SpuSubscribe` 实体代表一个产品订阅：

```php
use Tourze\ProductSubscribeBundle\Entity\SpuSubscribe;

$subscription = new SpuSubscribe();
$subscription->setGoodsId(123);
$subscription->setMemberId(456);
$subscription->setStatus(true);

// 实体会自动处理时间戳
```

### 仓库模式

使用仓库进行数据库操作：

```php
use Tourze\ProductSubscribeBundle\Repository\SpuSubscribeRepository;

class SubscriptionService
{
    public function __construct(
        private SpuSubscribeRepository $repository
    ) {}

    public function findUserSubscriptions(int $memberId): array
    {
        return $this->repository->findBy(['memberId' => $memberId]);
    }

    public function toggleSubscription(int $goodsId, int $memberId): void
    {
        $subscription = $this->repository->findOneBy([
            'goodsId' => $goodsId,
            'memberId' => $memberId
        ]);

        if ($subscription) {
            $subscription->setStatus(!$subscription->getStatus());
            $this->repository->save($subscription);
        }
    }
}
```

### 管理菜单集成

Bundle 会自动在"商品管理"（Product Management）部分注册管理菜单项，提供便捷的订阅管理访问入口。

## 开发

### 运行测试

运行全面的测试套件：

```bash
./vendor/bin/phpunit packages/product-subscribe-bundle/tests
```

### 静态分析

运行 PHPStan 进行静态分析：

```bash
./vendor/bin/phpstan analyze packages/product-subscribe-bundle --level=9
```

## API 参考

### 实体字段

| 字段 | 类型 | 访问器 | 描述 |
|------|------|--------|------|
| `id` | int | getId() | 唯一标识符 |
| `goodsId` | int | setGoodsId(), getGoodsId() | 产品 ID |
| `memberId` | int | setMemberId(), getMemberId() | 用户 ID |
| `status` | bool | setStatus(), getStatus() | 订阅状态 |
| `createdAt` | DateTime | getCreatedAt() | 创建时间戳（自动） |
| `updatedAt` | DateTime | getUpdatedAt() | 更新时间戳（自动） |

### 仓库方法

- `findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)`
- `findOneBy(array $criteria)`
- `find($id)`
- `findAll()`
- `save(SpuSubscribe $entity, bool $flush = true)`
- `remove(SpuSubscribe $entity, bool $flush = true)`
- `count(array $criteria = [])`

## 贡献

1. Fork 仓库
2. 创建功能分支
3. 进行修改
4. 为新功能添加测试
5. 运行测试套件
6. 提交 Pull Request

## 许可证

MIT 许可证。详情请参见 LICENSE 文件。

## 支持

如遇问题或有疑问：
- 在 GitHub 上创建 issue
- 查看文档
- 检查现有 issue