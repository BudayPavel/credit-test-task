<?php

declare(strict_types=1);

namespace App\Model\Client\Entity\VO;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class CityType extends StringType
{
    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): ?string
    {
        /** @var string|null $result */
        $result = $value instanceof City ? $value->getValue() : $value;
        return isset($result) ? trim($result) : null;
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?City
    {
        return isset($value) ? new City((string) $value) : null;
    }

    public function getName(): string
    {
        return City::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
