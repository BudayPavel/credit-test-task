<?php

declare(strict_types=1);

namespace App\Model\Client\Query\FindClient;

use App\Exception\EntityNotFoundException;
use App\Model\Client\Entity\Client\Client;
use App\Service\QueryBuilder\QueryBuilderInterface;

final readonly class Fetcher
{
    public function __construct(private QueryBuilderInterface $builder)
    {
    }

    public function getClient(Query $query): QueryClient
    {
        $qb = $this->builder->createQueryBuilder()
            ->select('*')
            ->from(Client::TABLE)
            ->andWhere('id = :client_id')
            ->setParameter('client_id', $query->id->getValue());

        /** @var array<string,string> $client */
        $client = $qb->fetchAssociative();

        if (!$client) {
            throw new EntityNotFoundException('Client not found.');
        }

        return new QueryClient(
            id: $client['id'],
            firstName: $client['first_name'],
            lastName: $client['last_name'],
            age: (int) $client['age'],
            state: (int) $client['address_state'],
            city: $client['address_city'],
            zipCode: $client['address_zip_code'],
            ssn: $client['ssn'],
            ficoScore: (int) $client['fico_score'],
            email: $client['email'],
            phone: $client['phone'],
            monthlyIncome: $client['monthly_income'] ? (float) $client['monthly_income'] : null,
        );
    }
}
