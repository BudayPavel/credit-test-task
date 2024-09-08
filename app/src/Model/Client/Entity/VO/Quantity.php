<?php

declare(strict_types=1);

namespace App\Model\Client\Entity\VO;

use Webmozart\Assert\Assert;

final class Quantity
{
    public const NAME = 'client_quantity';
    private readonly float $value;

    public function __construct(float $value)
    {
        Assert::greaterThanEq($value, 0.0, 'Quantity must be a positive number. Got: %s');
        $this->value = $value;
    }

    public function getValue(): float
    {
        return $this->value;
    }
}
