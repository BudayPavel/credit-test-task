<?php

declare(strict_types=1);

namespace App\Model\Loan\Constraint\IsEligibleForLoan;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
final class ClientAge extends Constraint
{
    public string $message = 'Age must be between {{ min_age }} and {{ max_age }} years old.';

    public function getTargets(): array|string
    {
        return self::PROPERTY_CONSTRAINT;
    }
}
