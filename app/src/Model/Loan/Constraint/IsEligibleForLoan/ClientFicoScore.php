<?php

declare(strict_types=1);

namespace App\Model\Loan\Constraint\IsEligibleForLoan;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
final class ClientFicoScore extends Constraint
{
    public string $message = 'The provided FICO score must be greater than {{ min_fico }}.';

    public function getTargets(): array|string
    {
        return self::PROPERTY_CONSTRAINT;
    }
}
