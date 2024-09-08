<?php

declare(strict_types=1);

namespace App\Model\Client\Controller\Client;

use App\Model\Client\Command\Create\Command;
use App\Model\Client\Command\Create\Handler;
use App\Model\Client\Command\Create\Request as ClientRequest;
use App\Model\Client\Entity\VO\Id;
use App\Service\Deserializer\JsonDeserializerInterface;
use App\Service\Response\ApiResponseInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/client/create', name: 'client_create', methods: ['POST'])]
final readonly class CreateController
{
    public function __construct(private JsonDeserializerInterface $deserializer, private ApiResponseInterface $response)
    {
    }

    public function __invoke(ClientRequest $clientRequest, Request $request, Handler $handler): Response
    {
        /** @var Command $command */
        $command = $this->deserializer->deserialize(
            $request->getContent(),
            new Command(
                id: $id = Id::generate()->getValue(),
                firstName: $clientRequest->firstName,
                lastName: $clientRequest->lastName,
                age: $clientRequest->age,
                state: $clientRequest->state,
                city: $clientRequest->city,
                zipCode: $clientRequest->zipCode,
                ssn: $command->ssn,
                ficoScore: $clientRequest->ficoScore,
                email: $clientRequest->email,
                phone: $clientRequest->phone,
            ),
            false,
            [],
        );

        $handler->handle($command);

        return $this->response->createResponse($id);
    }
}
