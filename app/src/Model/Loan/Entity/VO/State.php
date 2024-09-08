<?php

declare(strict_types=1);

namespace App\Model\Loan\Entity\VO;

enum State: int
{
    case CA = 1;
    case NY = 2;
    case NV = 3;

    public static function getCases(): array
    {
        return array_map(static fn (self $enum) => $enum->value, self::cases());
    }

    public function isEqual(self $other): bool
    {
        return $this->value === $other->value;
    }
}
