<?php

declare(strict_types=1);

namespace App\Service\Deserializer;

use App\Service\CommandHandler\CommandInterface;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

final readonly class JsonDeserializer implements JsonDeserializerInterface
{
    public const TYPE = 'json';

    public function __construct(private SerializerInterface $serializer)
    {
    }

    public function deserialize(
        mixed $data,
        CommandInterface $command,
        bool $disableTypeEnforcement = false,
        array $ignoredAttributes = ['id'],
    ): CommandInterface {
        /** @var CommandInterface */
        return $this->serializer->deserialize(
            $data,
            $command::class,
            self::TYPE,
            [
                'object_to_populate' => $command,
                'ignored_attributes' => $ignoredAttributes,
                AbstractObjectNormalizer::DISABLE_TYPE_ENFORCEMENT => $disableTypeEnforcement,
            ],
        );
    }
}
