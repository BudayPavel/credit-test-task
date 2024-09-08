<?php

declare(strict_types=1);

namespace App\Model\Loan\Entity\VO;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\DecimalType;

final class RateType extends DecimalType
{
    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): mixed
    {
        return $value instanceof Rate ? $value->getValue() : $value;
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?Rate
    {
        return isset($value) ? new Rate((float) $value) : null;
    }

    public function getName(): string
    {
        return Rate::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
