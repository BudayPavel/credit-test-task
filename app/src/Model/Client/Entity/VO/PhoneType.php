<?php

declare(strict_types=1);

namespace App\Model\Client\Entity\VO;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class PhoneType extends StringType
{
    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): ?string
    {
        /** @var string|null $result */
        $result = $value instanceof Phone ? $value->getValue() : $value;
        return isset($result) ? trim($result) : null;
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?Phone
    {
        return isset($value) ? new Phone((string) $value) : null;
    }

    public function getName(): string
    {
        return Phone::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
