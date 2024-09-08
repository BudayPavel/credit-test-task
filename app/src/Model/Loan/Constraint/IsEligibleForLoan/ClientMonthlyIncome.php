<?php

declare(strict_types=1);

namespace App\Model\Company\Constraint\Exist;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
final class ClientMonthlyIncome extends Constraint
{
    public string $message = 'The monthly income must be at least {{ min_income }}.';

    public function getTargets(): array|string
    {
        return self::PROPERTY_CONSTRAINT;
    }
}
