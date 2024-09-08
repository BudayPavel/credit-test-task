<?php

declare(strict_types=1);

namespace App\Model\Loan\Entity\VO;

use Webmozart\Assert\Assert;

class Name
{
    public const NAME = 'loan_name';
    private readonly string $value;

    public function __construct(string $value)
    {
        Assert::notEmpty($value);
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function isEqual(self $other): bool
    {
        return $this->getValue() === $other->getValue();
    }
}
