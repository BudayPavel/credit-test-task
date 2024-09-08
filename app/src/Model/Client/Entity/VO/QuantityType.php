<?php

declare(strict_types=1);

namespace App\Model\Client\Entity\VO;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\DecimalType;

final class QuantityType extends DecimalType
{
    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): mixed
    {
        return $value instanceof Quantity ? $value->getValue() : $value;
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?Quantity
    {
        return isset($value) ? new Quantity((float) $value) : null;
    }

    public function getName(): string
    {
        return Quantity::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
