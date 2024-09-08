<?php

declare(strict_types=1);

namespace App\Service\Paginator;

use App\Service\QueryBuilder\QueryBuilderInterface;

interface PaginateInterface
{
    public function paginate(
        QueryBuilderInterface $target,
        int $page = 1,
        ?int $limit = null,
        array $options = [],
    ): PaginateItemInterface;
}
