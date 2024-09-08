<?php

declare(strict_types=1);

namespace App\Model\Client\Entity\VO;

use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;

final class Id implements \Stringable
{
    public const NAME = 'client_uuid';
    private readonly string $value;

    public function __construct(string $value)
    {
        Assert::uuid($value);
        $this->value = mb_strtolower($value);
    }

    public function __toString(): string
    {
        return $this->getValue();
    }

    public static function generate(): self
    {
        return new self(Uuid::uuid4()->toString());
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
