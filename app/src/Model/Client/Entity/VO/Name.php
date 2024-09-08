<?php

declare(strict_types=1);

namespace App\Model\Client\Entity\VO;

use Webmozart\Assert\Assert;

class Name
{
    public const NAME = 'client_name';
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
