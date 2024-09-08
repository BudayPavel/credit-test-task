<?php

declare(strict_types=1);

namespace App\Model\Client\Entity\VO;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class NumberType extends StringType
{
    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): ?string
    {
        /** @var string|null $result */
        $result = $value instanceof Number ? $value->getValue() : $value;
        return isset($result) ? trim($result) : null;
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?Number
    {
        return isset($value) ? new Number((string) $value) : null;
    }

    public function getName(): string
    {
        return Number::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
