<?php

declare(strict_types=1);

namespace App\Model\Client\Entity\VO;

use Webmozart\Assert\Assert;

final class ZipCode
{
    public const NAME = 'client_zip_code';
    public const MAX_LENGTH = 10;

    private readonly string $value;

    public function __construct(string $value)
    {
        Assert::notEmpty($value = trim($value), 'Expected a non-empty zip-code.');
        Assert::maxLength($value, self::MAX_LENGTH, 'Zip-code is to long.');
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
