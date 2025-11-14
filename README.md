# Product Subscribe Bundle

[English](README.md) | [中文](README.zh-CN.md)

A Symfony bundle for managing product subscription functionality, providing comprehensive admin interface and robust repository management.

## Features

- **Product subscription entity management** with full CRUD operations
- **Admin interface** integrated with EasyAdmin for seamless management
- **Repository pattern implementation** following best practices
- **Timestamp tracking** for subscription records (created/updated)
- **User and product relationship management** with proper indexing
- **Database migrations** for easy setup and deployment
- **Comprehensive test coverage** ensuring reliability

## Installation

### Requirements

- PHP 8.1+
- Symfony 7.3+
- Doctrine ORM 3.0+
- EasyAdmin Bundle 4+

### Composer Installation

Add the bundle to your `composer.json`:

```bash
composer require tourze/product-subscribe-bundle
```

### Bundle Registration

Register the bundle in `config/bundles.php`:

```php
<?php

return [
    // ...
    Tourze\ProductSubscribeBundle\ProductSubscribeBundle::class => ['all' => true],
];
```

## Configuration

### Database Schema

Run migrations to create the subscription table:

```bash
php bin/console doctrine:migrations:migrate
```

The bundle creates the `ims_goods_subscribe` table with the following structure:

| Column | Type | Description |
|--------|------|-------------|
| `id` | bigint | Primary key (auto-increment) |
| `goods_id` | bigint | Product identifier (indexed) |
| `member_id` | bigint | User identifier (indexed) |
| `status` | boolean | Subscription status (active/inactive) |
| `created_at` | datetime | Creation timestamp |
| `updated_at` | datetime | Last update timestamp |

### Admin Interface

The bundle provides an admin interface accessible at `/admin/product/spu-subscribe` with:

- **List view** with filtering by product ID, user ID, and status
- **Create/Edit forms** for managing subscriptions
- **Pagination** (50 records per page)
- **Sorting** by ID (descending by default)
- **Search functionality** across all major fields

## Usage

### Entity Usage

The `SpuSubscribe` entity represents a product subscription:

```php
use Tourze\ProductSubscribeBundle\Entity\SpuSubscribe;

$subscription = new SpuSubscribe();
$subscription->setGoodsId(123);
$subscription->setMemberId(456);
$subscription->setStatus(true);

// The entity will automatically handle timestamps
```

### Repository Pattern

Use the repository for database operations:

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

### Admin Menu Integration

The bundle automatically registers admin menu items under the "Product Management" (商品管理) section, providing easy access to subscription management.

## Development

### Running Tests

Run the comprehensive test suite:

```bash
./vendor/bin/phpunit packages/product-subscribe-bundle/tests
```

### Static Analysis

Run PHPStan for static analysis:

```bash
./vendor/bin/phpstan analyze packages/product-subscribe-bundle --level=9
```

## API Reference

### Entity Fields

| Field | Type | Accessors | Description |
|-------|------|-----------|-------------|
| `id` | int | getId() | Unique identifier |
| `goodsId` | int | setGoodsId(), getGoodsId() | Product ID |
| `memberId` | int | setMemberId(), getMemberId() | User ID |
| `status` | bool | setStatus(), getStatus() | Subscription status |
| `createdAt` | DateTime | getCreatedAt() | Creation timestamp (auto) |
| `updatedAt` | DateTime | getUpdatedAt() | Update timestamp (auto) |

### Repository Methods

- `findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)`
- `findOneBy(array $criteria)`
- `find($id)`
- `findAll()`
- `save(SpuSubscribe $entity, bool $flush = true)`
- `remove(SpuSubscribe $entity, bool $flush = true)`
- `count(array $criteria = [])`

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests for new functionality
5. Run the test suite
6. Submit a pull request

## License

MIT License. See LICENSE file for details.

## Support

For issues and questions:
- Create an issue on GitHub
- Check the documentation
- Review existing issues