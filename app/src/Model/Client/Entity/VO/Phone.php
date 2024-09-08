<?php

declare(strict_types=1);

namespace App\Model\Client\Entity\VO;

use Webmozart\Assert\Assert;

final class Phone
{
    public const NAME = 'client_phone';
    private readonly string $value;

    public function __construct(string $value)
    {
        Assert::notEmpty($value = trim($value), 'Expected a non-empty phone.');
        if (!preg_match('/^[0-9+-\/\s()]+$/', $value)) {
            throw new \InvalidArgumentException('Incorrect phone.');
        }
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
