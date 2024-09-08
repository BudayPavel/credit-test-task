<?php

declare(strict_types=1);

namespace App\Service\QueryBuilder\Factory;

use App\Service\QueryBuilder\Doctrine\DoctrineQueryBuilder;
use App\Service\QueryBuilder\QueryBuilderInterface;
use Doctrine\DBAL\Connection;

final readonly class PostgresDbFactory implements DbFactoryInterface
{
    public function __construct(private Connection $connection)
    {
    }

    public function create(): QueryBuilderInterface
    {
        return new DoctrineQueryBuilder($this->connection);
    }
}
