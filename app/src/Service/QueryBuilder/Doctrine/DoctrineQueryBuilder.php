<?php

declare(strict_types=1);

namespace App\Service\QueryBuilder\Doctrine;

use App\Service\QueryBuilder\QueryBuilderInterface;
use Countable;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Query\QueryBuilder;

final class DoctrineQueryBuilder implements QueryBuilderInterface, DoctrineQueryInterface
{
    private QueryBuilder $queryBuilder;

    public function __construct(public Connection $connection)
    {
        $this->queryBuilder = $connection->createQueryBuilder();
    }

    public function select(string $params): self
    {
        $this->queryBuilder->select($params);
        return $this;
    }

    public function addSelect(string $params): self
    {
        $this->queryBuilder->addSelect($params);
        return $this;
    }

    public function from(string $from, ?string $alias = null): self
    {
        $this->queryBuilder->from($from, $alias);
        return $this;
    }

    public function innerJoin(string $fromAlias, string $join, string $alias, ?string $condition = null): self
    {
        $this->queryBuilder->innerJoin($fromAlias, $join, $alias, $condition);
        return $this;
    }

    public function leftJoin(string $fromAlias, string $join, string $alias, ?string $condition = null): self
    {
        $this->queryBuilder->leftJoin($fromAlias, $join, $alias, $condition);
        return $this;
    }

    public function where(string|Countable $predicates): self
    {
        $this->queryBuilder->where($predicates);
        return $this;
    }

    public function andWhere(string|Countable $predicates): self
    {
        $this->queryBuilder->andWhere($predicates);
        return $this;
    }

    public function setParameter(string $key, string|int|array|null $value, int $type = ParameterType::STRING): self
    {
        $this->queryBuilder->setParameter($key, $value, $type);
        return $this;
    }

    public function getParameters(): array
    {
        return $this->queryBuilder->getParameters();
    }

    public function setParameters(array $params, array $types = []): self
    {
        $this->queryBuilder->setParameters($params, $types);
        return $this;
    }

    public function orderBy(string $sort, ?string $order = null): self
    {
        $this->queryBuilder->orderBy($sort, $order);
        return $this;
    }

    public function addOrderBy(string $sort, ?string $order = null): self
    {
        $this->queryBuilder->addOrderBy($sort, $order);
        return $this;
    }

    public function groupBy(string $params): self
    {
        $this->queryBuilder->groupBy($params);
        return $this;
    }

    public function addGroupBy(string $params): self
    {
        $this->queryBuilder->addGroupBy($params);
        return $this;
    }

    public function having(string $params): self
    {
        $this->queryBuilder->having($params);
        return $this;
    }

    public function andHaving(string $params): self
    {
        $this->queryBuilder->andHaving($params);
        return $this;
    }

    public function setFirstResult(int $firstResult): self
    {
        $this->queryBuilder->setFirstResult($firstResult);
        return $this;
    }

    public function setMaxResults(?int $params): self
    {
        $this->queryBuilder->setMaxResults($params);
        return $this;
    }

    public function fetchOne(): int|string|false
    {
        $result = $this->queryBuilder->executeQuery()->fetchOne();
        $this->resetSql();
        return $result;
    }

    public function fetchAssociative(): array|false
    {
        $result = $this->queryBuilder->executeQuery()->fetchAssociative();
        $this->resetSql();
        return $result;
    }

    public function fetchAllAssociative(): array
    {
        $result = $this->queryBuilder->executeQuery()->fetchAllAssociative();
        $this->resetSql();
        return $result;
    }

    public function fetchAllKeyValue(): array
    {
        $result = $this->queryBuilder->executeQuery()->fetchAllKeyValue();
        $this->resetSql();
        return $result;
    }

    public function fetchFirstColumn(): array
    {
        $result = $this->queryBuilder->executeQuery()->fetchFirstColumn();
        $this->resetSql();
        return $result;
    }

    public function rowCount(): int
    {
        $result = $this->queryBuilder->executeQuery()->rowCount();
        $this->resetSql();
        return $result;
    }

    public function getQueryBuilder(): QueryBuilder
    {
        return $this->queryBuilder;
    }

    public function createQueryBuilder(): self
    {
        return new self($this->connection);
    }

    private function resetSql(): void
    {
        $this->queryBuilder->resetQueryParts();
    }

    public function getSql(): string
    {
        return $this->queryBuilder->getSQL();
    }

    public function clone(): self
    {
        $clone = clone $this;
        $clone->queryBuilder = clone $this->queryBuilder;
        return $clone;
    }

    public function limit(int $limit): self
    {
        $this->queryBuilder->setMaxResults($limit);
        return $this;
    }
}
