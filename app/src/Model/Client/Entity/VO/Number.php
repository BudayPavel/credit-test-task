<?php

declare(strict_types=1);

namespace App\Model\Client\Entity\VO;

use Webmozart\Assert\Assert;

final readonly class Number
{
    public const NAME = 'client_number';
    public const MAX_LENGTH = 255;

    private string $value;

    public function __construct(string $value)
    {
        Assert::notEmpty($value = trim($value), 'Expected a non-empty number.');
        Assert::maxLength($value, self::MAX_LENGTH, 'Number is to long.');
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
