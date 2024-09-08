<?php

declare(strict_types=1);

namespace App\Service\ArgumentResolver;

use App\Service\Request\BodyRequestInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final readonly class BodyRequestResolver implements ValueResolverInterface
{
    public function __construct(private DenormalizerInterface $denormalizer)
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
        $object = $this->denormalizer->denormalize(
            $request->getContent(),
            $type,
            null,
            [AbstractObjectNormalizer::DISABLE_TYPE_ENFORCEMENT => true],
        );

        return [$object];
    }
}
