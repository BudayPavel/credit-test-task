<?php

declare(strict_types=1);

namespace App\Service\QueryBuilder\Doctrine;

use Doctrine\DBAL\Query\QueryBuilder;

interface DoctrineQueryInterface
{
    public function getQueryBuilder(): QueryBuilder;
}
