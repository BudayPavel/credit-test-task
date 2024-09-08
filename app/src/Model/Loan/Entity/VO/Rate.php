<?php

declare(strict_types=1);

namespace App\Model\Loan\Entity\VO;

use Webmozart\Assert\Assert;

final class Rate
{
    public const NAME = 'loan_rate';
    public const CALIFORNIA_INTEREST_RATE_INCREASE = 11.49;
    private readonly float $value;

    public function __construct(float $value)
    {
        Assert::greaterThanEq($value, 0.0, 'Rate must be a positive number. Got: %s');
        $this->value = $value;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function calculateInterestRate(State $state): self
    {
        if ($state->isEqual(State::CA)) {
            $value = $this->value;
            $value += self::CALIFORNIA_INTEREST_RATE_INCREASE;

            return new self($value);
        }

        return $this;
    }
}
