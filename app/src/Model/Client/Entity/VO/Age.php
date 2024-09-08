<?php

declare(strict_types=1);

namespace App\Model\Client\Entity\VO;

use Webmozart\Assert\Assert;

final class Age
{
    public const NAME = 'client_age';
    public const MIN = 18;
    public const MAX = 60;

    private readonly int $value;

    public function __construct(int $value)
    {
        Assert::greaterThanEq($value, 0, 'The age must be a positive integer. Got: %s');
        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
