<?php

declare(strict_types=1);

namespace App\Model\Client\Entity\VO;

use BackedEnum;

enum State: int
{
    public const NAME = 'client_state';

    case CA = 1;
    case NY = 2;
    case NV = 3;

    public function toString(): BackedEnum
    {
        return match ($this) {
            self::CA => StateValue::CA,
            self::NY => StateValue::NY,
            self::NV => StateValue::NV,
        };
    }

    public static function getCases(): array
    {
        return array_map(static fn (self $enum) => $enum->value, self::cases());
    }
}
