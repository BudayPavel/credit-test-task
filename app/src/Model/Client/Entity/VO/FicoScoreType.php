<?php

declare(strict_types=1);

namespace App\Model\Client\Entity\VO;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

final class FicoScoreType extends IntegerType
{
    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): mixed
    {
        return $value instanceof FicoScore ? $value->getValue() : $value;
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?FicoScore
    {
        return isset($value) ? new FicoScore((int) $value) : null;
    }

    public function getName(): string
    {
        return FicoScore::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
