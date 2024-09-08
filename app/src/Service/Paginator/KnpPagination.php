<?php

declare(strict_types=1);

namespace App\Service\Paginator;

use App\Service\QueryBuilder\QueryBuilderInterface;
use Knp\Component\Pager\PaginatorInterface;

final readonly class KnpPagination implements PaginateInterface
{
    public function __construct(private PaginatorInterface $paginateAdapter)
    {
    }

    public function paginate(
        QueryBuilderInterface $target,
        int $page = 1,
        ?int $limit = null,
        array $options = [],
    ): PaginateItemInterface {
        $query = $target->getQueryBuilder();
        $paginatorItem = $this->paginateAdapter->paginate($query, $page, $limit, $options);
        $query->resetQueryParts();

        return new KnpPaginateItem($paginatorItem);
    }
}
