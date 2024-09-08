<?php

declare(strict_types=1);

namespace App\Service\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

readonly class ApiResponse implements ApiResponseInterface
{
    public function __construct(private SerializerInterface $serializer)
    {
    }

    public function jsonResponse(array $data, int $code = Response::HTTP_OK): JsonResponse
    {
        return new JsonResponse($data, $code, [], false);
    }

    public function jsonResponseObject(object $object, int $code = Response::HTTP_OK): JsonResponse
    {
        return new JsonResponse($this->serializer->serialize($object, 'json'), $code, [], true);
    }

    public function emptyResponse(): JsonResponse
    {
        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }

    public function createResponse(string $id): JsonResponse
    {
        return new JsonResponse(['id' => $id], Response::HTTP_CREATED);
    }

    public function response(?string $content = '', array $headers = [], int $code = Response::HTTP_OK): JsonResponse
    {
        return new JsonResponse($content, $code, $headers, true);
    }
}
