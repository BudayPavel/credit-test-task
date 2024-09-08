<?php

declare(strict_types=1);

namespace App\Service\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

interface ApiResponseInterface
{
    public function jsonResponse(array $data, int $code = Response::HTTP_OK): JsonResponse;

    public function jsonResponseObject(object $object, int $code = Response::HTTP_OK): JsonResponse;

    public function emptyResponse(): JsonResponse;

    public function createResponse(string $id): JsonResponse;

    public function response(?string $content = '', array $headers = [], int $code = Response::HTTP_OK): Response;
}
