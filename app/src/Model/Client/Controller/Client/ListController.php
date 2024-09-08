<?php

declare(strict_types=1);

namespace App\Model\Client\Controller\Client;

use App\Model\Client\Query\FindClientList\Fetcher;
use App\Model\Client\Query\FindClientList\Query;
use App\Service\Response\ApiResponseInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/client/list', name: 'client_list', methods: ['GET'])]
final readonly class ListController
{
    public function __construct(
        private Fetcher $fetcher,
        private ApiResponseInterface $response,
    ) {
    }

    public function __invoke(Query $query): JsonResponse
    {
        $pagination = $this->fetcher->getAll($query);

        $response = [
            'items' => $pagination->getItems(),
            'pagination' => [
                'count' => $pagination->count(),
                'total' => $pagination->getTotalItemCount(),
                'per_page' => $pagination->getItemNumberPerPage(),
                'page' => $pagination->getCurrentPageNumber(),
                'pages' => ceil($pagination->getTotalItemCount() / $pagination->getItemNumberPerPage()),
            ],
        ];

        return $this->response->jsonResponse($response);
    }
}
