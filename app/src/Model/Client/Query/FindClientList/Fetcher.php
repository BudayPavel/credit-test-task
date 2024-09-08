<?php

declare(strict_types=1);

namespace App\Model\Client\Query\FindClientList;

use App\Model\Client\Entity\Client\Client;
use App\Service\Paginator\PaginateItemInterface;
use App\Service\Paginator\PaginateInterface;
use App\Service\QueryBuilder\QueryBuilderInterface;

final readonly class Fetcher
{
    public function __construct(private QueryBuilderInterface $builder, private PaginateInterface $paginator)
    {
    }

    public function getAll(Query $query): PaginateItemInterface
    {
        $queryBuilder = $this->builder->createQueryBuilder()
            ->select('*')
            ->from(Client::TABLE);

        $this->applySort($queryBuilder, $query->sort, $query->direction);

        return $this->paginator->paginate($queryBuilder, $query->page, $query->perPage);
    }

    private function applySort(QueryBuilderInterface $qb, ?string $sort, ?string $direction): void
    {
        if ($sort) {
            $qb->orderBy($sort, $direction);
        }
    }
}
