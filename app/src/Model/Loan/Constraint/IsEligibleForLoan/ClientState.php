<?php

declare(strict_types=1);

namespace App\Model\Loan\Constraint\IsEligibleForLoan;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
final class ClientState extends Constraint
{
    public string $message = 'The state you entered is not eligible for a loan. Only CA, NY, and NV are accepted.';
    public string $messageForNY = 'Unfortunately, the loan application has been randomly rejected.';

    public function getTargets(): array|string
    {
        return self::PROPERTY_CONSTRAINT;
    }
}
