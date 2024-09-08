<?php

declare(strict_types=1);

namespace App\Model\Loan\Entity\Loan;

use Doctrine\ORM\EntityManagerInterface;

final readonly class LoanRepository
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function add(Loan $loan): void
    {
        $this->em->persist($loan);
    }
}
