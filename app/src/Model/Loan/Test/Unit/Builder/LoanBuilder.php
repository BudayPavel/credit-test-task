<?php

declare(strict_types=1);

namespace App\Model\Loan\Test\Unit\Builder;

use App\Model\Loan\Entity\Loan\Loan;
use App\Model\Loan\Entity\VO\Amount;
use App\Model\Loan\Entity\VO\Id;
use App\Model\Loan\Entity\VO\Name;
use App\Model\Loan\Entity\VO\Rate;
use App\Model\Loan\Entity\VO\Term;

final readonly class LoanBuilder
{
    public const TEST_ID = 'f3272e32-78f4-122a-3408-4a4f4b865ef1';
    public const TEST_CLIENT_ID = 'f2172e32-78f4-122a-3408-4a4f4b865ef1';
    public const TEST_NAME = 'Test name';
    public const TEST_TERM = 20;
    public const TEST_RATE = 12;
    public const TEST_AMOUNT = 1200;

    private function __construct(
        private Id $id,
        private Id $clientId,
        private Name $name,
        private Term $term,
        private Rate $interestRate,
        private Amount $amount,
    ) {
    }

    public static function create(): self
    {
        return new self(
            id: new Id(self::TEST_ID),
            clientId: new Id(self::TEST_CLIENT_ID),
            name: new Name(self::TEST_NAME),
            term: new Term(self::TEST_TERM),
            interestRate: new Rate(self::TEST_RATE),
            amount: new Amount(self::TEST_AMOUNT),
        );
    }

    public function buildLoan(): Loan
    {
        return Loan::create(
            id: $this->id,
            clientId: $this->clientId,
            name: $this->name,
            term: $this->term,
            interestRate: $this->interestRate,
            amount: $this->amount,
        );
    }
}
