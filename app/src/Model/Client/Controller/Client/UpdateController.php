<?php

declare(strict_types=1);

namespace App\Model\Client\Controller\Client;

use App\Model\Client\Command\Edit\Command;
use App\Model\Client\Command\Edit\Handler;
use App\Model\Client\Entity\VO\Id;
use App\Model\Client\Query\FindClientForUpdate\Fetcher;
use App\Model\Client\Query\FindClientForUpdate\Query;
use App\Service\Deserializer\JsonDeserializerInterface;
use App\Service\Response\ApiResponseInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/client/{id}/update', name: 'client_update', methods: ['PUT'])]
final readonly class UpdateController
{
    public function __construct(
        private JsonDeserializerInterface $deserializer,
        private ApiResponseInterface $response,
        private Fetcher $fetcher,
    ) {
    }

    public function __invoke(Request $request, Handler $handler, string $id): JsonResponse
    {
        $company = $this->fetcher->getClient(new Query(new Id($id)));
        /** @var Command $command */
        $command = $this->deserializer->deserialize($request->getContent(), $company);
        $handler->handle($command);

        return $this->response->jsonResponse(['id' => $id]);
    }
}
