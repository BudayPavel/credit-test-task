<?php

declare(strict_types=1);

namespace App\Service\ArgumentResolver;

use App\Service\Request\BodyRequestInterface;
use App\Service\Validator\ValidationInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\SerializerInterface;

final readonly class BodyRequestResolver implements ValueResolverInterface
{
    public const TYPE = 'json';

    public function __construct(private SerializerInterface $serializer, private ValidationInterface $validator)
    {
    }

    public function resolve(Request $request, ArgumentMetadata $argument): array
    {
        /** @var string $type */
        $type = $argument->getType();
        if ($type === null || !\is_subclass_of($type, BodyRequestInterface::class)) {
            return [];
        }

        /** @var object $object */
        $object = $this->serializer->deserialize(
            $request->getContent(),
            $type,
            self::TYPE,
        );

        $this->validator->validate($object);

        return [$object];
    }
}
