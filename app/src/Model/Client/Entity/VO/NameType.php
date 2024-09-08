<?php

declare(strict_types=1);

namespace App\Model\Client\Entity\VO;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class NameType extends StringType
{
    final public const NAME = 'user_name';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        return $value instanceof Name ? $value->getValue() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Name
    {
        return !empty($value) ? new Name((string)$value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
