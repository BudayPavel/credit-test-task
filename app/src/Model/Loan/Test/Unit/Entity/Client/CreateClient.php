<?php

declare(strict_types=1);

namespace App\Model\Loan\Test\Unit\Entity\User;

use App\Model\Loan\Entity\Loan\Loan;
use App\Model\Loan\Test\Unit\Builder\LoanBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Model\Client\Entity\Client\Client::create
 * @internal
 */
final class CreateClient extends TestCase
{
    public function testSuccessCreate(): void
    {
        $client = LoanBuilder::create()->buildLoan();
        $this->assertInstanceOf(Loan::class, $client);
    }
}
