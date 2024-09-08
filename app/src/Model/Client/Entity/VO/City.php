<?php

declare(strict_types=1);

namespace App\Model\Client\Entity\VO;

use Webmozart\Assert\Assert;

final readonly class City
{
    public const NAME = 'client_city';
    public const MAX_LENGTH = 100;

    private string $value;

    public function __construct(string $value)
    {
        Assert::notEmpty($value = trim($value), 'Expected a non-empty city.');
        Assert::maxLength($value, self::MAX_LENGTH, 'City is to long.');
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
