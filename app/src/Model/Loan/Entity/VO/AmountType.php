<?php

declare(strict_types=1);

namespace App\Model\Loan\Entity\VO;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\DecimalType;

final class AmountType extends DecimalType
{
    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): mixed
    {
        return $value instanceof Amount ? $value->getValue() : $value;
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?Amount
    {
        return isset($value) ? new Amount((float) $value) : null;
    }

    public function getName(): string
    {
        return Amount::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
