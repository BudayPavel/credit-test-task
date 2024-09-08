<?php

declare(strict_types=1);

namespace App\Service\QueryBuilder\Factory;

use App\Service\QueryBuilder\QueryBuilderInterface;

interface DbFactoryInterface
{
    public function create(): QueryBuilderInterface;
}
