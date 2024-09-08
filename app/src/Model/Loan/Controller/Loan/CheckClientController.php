<?php

declare(strict_types=1);

namespace App\Model\Loan\Controller\Client;

use App\Model\Loan\Entity\VO\Id;
use App\Model\Loan\Query\CheckClient\Fetcher;
use App\Model\Loan\Query\CheckClient\Query;
use App\Service\Response\ApiResponseInterface;
use App\Service\Validator\ValidationInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/loan/client/{clientId}/check', name: 'loan_client_check', methods: ['GET'])]
final readonly class CheckClientController
{
    public function __construct(
        private Fetcher $fetcher,
        private ApiResponseInterface $response,
        private ValidationInterface $validator,
    ) {
    }

    public function __invoke(string $programId, string $clientId): JsonResponse
    {
        $command = $this->fetcher->getClient(new Query(new Id($clientId)));
        $this->validator->validate($command);

        return $this->response->emptyResponse();
    }
}
