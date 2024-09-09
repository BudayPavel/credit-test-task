<?php

declare(strict_types=1);

namespace App\Service\ArgumentResolver;

use App\Service\Request\QueryRequestInterface;
use App\Service\Validator\ValidationInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final readonly class QueryRequestResolver implements ValueResolverInterface
{
    public function __construct(private DenormalizerInterface $denormalizer, private ValidationInterface $validator)
    {
    }

    public function resolve(Request $request, ArgumentMetadata $argument): array
    {
        /** @var string $type */
        $type = $argument->getType();
        if ($type === null || !\is_subclass_of($type, QueryRequestInterface::class)) {
            return [];
        }

        /** @var object $object */
        $object = $this->denormalizer->denormalize(
            $request->query->all(),
            $type,
            null,
            [AbstractObjectNormalizer::DISABLE_TYPE_ENFORCEMENT => true],
        );

        $this->validator->validate($object);

        return [$object];
    }
}
