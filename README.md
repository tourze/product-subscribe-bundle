# Product Subscribe Bundle

[English](README.md) | [中文](README.zh-CN.md)

A Symfony bundle for managing product subscription functionality.

## Features

- Product subscription entity management
- Admin interface for managing subscriptions
- Repository pattern implementation
- Integration with EasyAdmin for CRUD operations
- Timestamp tracking for subscription records
- User and product relationship management

## Installation

Add the bundle to your `composer.json`:

```bash
composer require tourze/product-subscribe-bundle
```

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
- `id`: Primary key
- `goods_id`: Product identifier
- `member_id`: User identifier  
- `status`: Subscription status (boolean)
- `created_at`: Creation timestamp
- `updated_at`: Last update timestamp

### Admin Interface

The bundle provides an admin interface accessible at `/admin/product/spu-subscribe` with:
- List view with filtering by product ID, user ID, and status
- Create/Edit forms for managing subscriptions
- Pagination (50 records per page)
- Sorting by ID (descending by default)

## Usage

### Entity

The `SpuSubscribe` entity represents a product subscription:

```php
use Tourze\ProductSubscribeBundle\Entity\SpuSubscribe;

$subscription = new SpuSubscribe();
$subscription->setGoodsId(123);
$subscription->setMemberId(456);
$subscription->setStatus(true);
```

### Repository

Use the repository for database operations:

```php
use Tourze\ProductSubscribeBundle\Repository\SpuSubscribeRepository;

class SomeService
{
    public function __construct(
        private SpuSubscribeRepository $repository
    ) {}
    
    public function findUserSubscriptions(int $memberId): array
    {
        return $this->repository->findBy(['memberId' => $memberId]);
    }
}
```

### Admin Menu

The bundle automatically registers admin menu items under the "���" (Product Management) section.

## Dependencies

- PHP 8.1+
- Symfony 7.3+
- Doctrine ORM 3.0+
- EasyAdmin Bundle 4+

## Testing

Run the test suite:

```bash
./vendor/bin/phpunit packages/product-subscribe-bundle/tests
```

## License

MIT License. See LICENSE file for details.