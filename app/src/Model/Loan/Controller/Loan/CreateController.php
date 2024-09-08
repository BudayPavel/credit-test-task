<?php

declare(strict_types=1);

namespace App\Model\Loan\Controller\Loan;

use App\Exception\ValidationException;
use App\Model\Loan\Command\Create\Command;
use App\Model\Loan\Command\Create\Handler;
use App\Model\Loan\Command\Create\Request as LoanRequest;
use App\Model\Loan\Entity\VO\Id;
use App\Model\Loan\Query\CheckClient\Fetcher;
use App\Model\Loan\Query\CheckClient\Query;
use App\Model\Loan\Service\NotificationService;
use App\Service\Response\ApiResponseInterface;
use App\Service\Validator\ValidationInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/loan/create', name: 'loan_create', methods: ['POST'])]
final readonly class CreateController
{
    public function __construct(
        private Fetcher $fetcher,
        private ApiResponseInterface $response,
        private ValidationInterface $validator,
        private NotificationService $notificationService,
    ) {
    }

    public function __invoke(LoanRequest $loanRequest, Request $request, Handler $handler): Response
    {
        $command = $this->fetcher->getClient(new Query(new Id($loanRequest->clientId)));
        try {
            $this->validator->validate($command);
        } catch (ValidationException $e) {
            $this->notificationService->sendEmail($command->email, 'Error');
            $this->notificationService->sendSMS($command->phone, 'Error');
            return $this->response->jsonResponse($e->getViolationList(), JsonResponse::HTTP_BAD_REQUEST);
        }

        $handler->handle(new Command(
            id: $id = Id::generate()->getValue(),
            clientId: $loanRequest->clientId,
            name: $loanRequest->name,
            term: $loanRequest->term,
            state: $command->state,
            interestRate: $loanRequest->interestRate,
            amount: $loanRequest->amount,
        ));

        $this->notificationService->sendEmail($command->email, 'Success');
        $this->notificationService->sendSMS($command->phone, 'Success');

        return $this->response->createResponse($id);
    }
}
