<?php

declare(strict_types=1);

namespace App\Model\Client\Entity\VO;

use Webmozart\Assert\Assert;

class Email
{
    public const NAME = 'client_email';
    private readonly string $value;

    public function __construct(string $value)
    {
        Assert::notEmpty($value);
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Incorrect email.');
        }
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
