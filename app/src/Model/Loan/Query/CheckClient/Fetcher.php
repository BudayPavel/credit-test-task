<?php

declare(strict_types=1);

namespace App\Model\Loan\Query\CheckClient;

use App\Exception\EntityNotFoundException;
use App\Model\Loan\Command\CheckClient\Command;
use App\Model\Loan\Entity\Loan\Loan;
use App\Service\QueryBuilder\QueryBuilderInterface;

final readonly class Fetcher
{
    public function __construct(private QueryBuilderInterface $builder)
    {
    }

    public function getClient(Query $query): Command
    {
        $qb = $this->builder->createQueryBuilder()
            ->select('email, phone, age, address_state, fico_score, monthly_income')
            ->from(Loan::CLIENT_TABLE)
            ->andWhere('id = :client_id')
            ->setParameter('client_id', $query->clientId->getValue());

        /** @var array<string,string> $client */
        $client = $qb->fetchAssociative();

        if (!$client) {
            throw new EntityNotFoundException('Client not found.');
        }

        return Command::fromClient(
            email: $client['email'],
            phone: $client['phone'],
            age: (int) $client['age'],
            state: (int) $client['address_state'],
            ficoScore: (int) $client['fico_score'],
            monthlyIncome: $client['monthly_income'] ? (float) $client['monthly_income'] : null,
        );
    }
}
