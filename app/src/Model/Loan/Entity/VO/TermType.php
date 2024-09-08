<?php

declare(strict_types=1);

namespace App\Model\Loan\Entity\VO;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

final class TermType extends IntegerType
{
    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): mixed
    {
        return $value instanceof Term ? $value->getValue() : $value;
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?Term
    {
        return isset($value) ? new Term((int) $value) : null;
    }

    public function getName(): string
    {
        return Term::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
