<?php

declare(strict_types=1);

namespace App\Model\Client\Controller\Client;

use App\Model\Client\Entity\VO\Id;
use App\Model\Client\Query\FindClient\Fetcher;
use App\Model\Client\Query\FindClient\Query;
use App\Service\Response\ApiResponseInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/client/{id}', name: 'client_show', methods: ['GET'])]
final readonly class ShowController
{
    public function __construct(private Fetcher $fetcher, private ApiResponseInterface $response)
    {
    }

    public function __invoke(string $programId, string $id): JsonResponse
    {
        $company = $this->fetcher->getClient(new Query(new Id($id)));

        return $this->response->jsonResponse($company->toArray());
    }
}
