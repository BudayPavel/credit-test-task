<?php

declare(strict_types=1);

namespace App\Service\QueryBuilder;

use Countable;
use PDO;

interface QueryBuilderInterface
{
    public function select(string $params): self;
    public function addSelect(string $params): self;
    public function from(string $from, ?string $alias = null): self;
    public function innerJoin(string $fromAlias, string $join, string $alias, ?string $condition = null): self;
    public function leftJoin(string $fromAlias, string $join, string $alias, ?string $condition = null): self;
    public function where(string|Countable $predicates): self;
    public function andWhere(string|Countable $predicates): self;
    public function getParameters(): array;
    public function setParameters(array $params, array $types = []): self;
    public function setParameter(string $key, string|int|array|null $value, int $type = PDO::PARAM_STR): self;
    public function orderBy(string $sort, ?string $order = null): self;
    public function addOrderBy(string $sort, ?string $order = null): self;
    public function groupBy(string $params): self;
    public function addGroupBy(string $params): self;
    public function having(string $params): self;
    public function andHaving(string $params): self;
    public function setFirstResult(int $firstResult): self;
    public function setMaxResults(?int $params): self;
    public function fetchOne(): int|string|false;
    public function fetchAssociative(): array|false;
    public function fetchAllAssociative(): array;
    public function fetchAllKeyValue(): array;
    public function fetchFirstColumn(): array;
    public function rowCount(): int;
    public function getSql(): string;
    public function clone(): QueryBuilderInterface;
    public function createQueryBuilder(): self;
    public function limit(int $limit): self;
}
