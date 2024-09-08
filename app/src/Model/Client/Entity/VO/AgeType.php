<?php

declare(strict_types=1);

namespace App\Model\Client\Entity\VO;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

final class AgeType extends IntegerType
{
    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): mixed
    {
        return $value instanceof Age ? $value->getValue() : $value;
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?Age
    {
        return isset($value) ? new Age((int) $value) : null;
    }

    public function getName(): string
    {
        return Age::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
