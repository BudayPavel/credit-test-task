<?php

declare(strict_types=1);

namespace App\Model\Client\Entity\VO;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\SmallIntType;

final class StateType extends SmallIntType
{
    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): int
    {
        return $value instanceof State ? $value->value : (int) $value;
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?State
    {
        if (!$class = State::tryFrom((int) $value)) {
            return null;
        }

        if (!enum_exists($class::class)) {
            throw new \LogicException('This class should be an enum');
        }

        return $class;
    }

    public function getName(): string
    {
        return State::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
