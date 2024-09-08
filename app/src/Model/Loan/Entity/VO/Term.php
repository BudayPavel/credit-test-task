<?php

declare(strict_types=1);

namespace App\Model\Loan\Entity\VO;

use Webmozart\Assert\Assert;

final readonly class Term
{
    public const NAME = 'loan_term';
    private int $value;

    public function __construct(int $value)
    {
        Assert::greaterThanEq($value, 0, 'The term must be a positive integer. Got: %s');
        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
