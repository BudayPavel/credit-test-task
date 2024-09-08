<?php

declare(strict_types=1);

namespace App\Model\Loan\Entity\VO;

use Webmozart\Assert\Assert;

final class Amount
{
    public const NAME = 'loan_amount';
    private readonly float $value;

    public function __construct(float $value)
    {
        Assert::greaterThanEq($value, 0.0, 'Amount must be a positive number. Got: %s');
        $this->value = $value;
    }

    public function getValue(): float
    {
        return $this->value;
    }
}
