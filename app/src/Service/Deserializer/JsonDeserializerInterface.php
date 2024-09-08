<?php

declare(strict_types=1);

namespace App\Service\Deserializer;

use App\Service\CommandHandler\CommandInterface;

interface JsonDeserializerInterface
{
    public function deserialize(
        mixed $data,
        CommandInterface $command,
        bool $disableTypeEnforcement = false,
        array $ignoredAttributes = [],
    ): CommandInterface;
}
