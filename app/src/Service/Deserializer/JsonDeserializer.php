<?php

declare(strict_types=1);

namespace App\Service\Deserializer;

use App\Service\CommandHandler\CommandInterface;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final readonly class JsonDeserializer implements JsonDeserializerInterface
{
    public function __construct(private DenormalizerInterface $denormalizer)
    {
    }

    public function deserialize(
        mixed $data,
        CommandInterface $command,
        bool $disableTypeEnforcement = false,
        array $ignoredAttributes = ['id'],
    ): CommandInterface {
        /** @var CommandInterface */
        return $this->denormalizer->denormalize(
            $data,
            $command::class,
            null,
            [
                'object_to_populate' => $command,
                'ignored_attributes' => $ignoredAttributes,
                AbstractObjectNormalizer::DISABLE_TYPE_ENFORCEMENT => $disableTypeEnforcement,
            ],
        );
    }
}
