<?php

declare(strict_types=1);

namespace App\Model\Loan\Command\Create;

use App\Model\Loan\Entity\Loan\Loan;
use App\Model\Loan\Entity\Loan\LoanRepository;
use App\Model\Loan\Entity\VO\Rate;
use App\Model\Loan\Entity\VO\State;
use App\Model\Loan\Entity\VO\Term;
use App\Model\Loan\Entity\VO\Id;
use App\Model\Loan\Entity\VO\Name;
use App\Model\Loan\Entity\VO\Amount;
use App\Service\CommandHandler\CommandHandlerInterface;
use App\Service\CommandHandler\CommandInterface;
use App\Service\Flusher\FlusherInterface;
use App\Service\Validator\ValidationInterface;

/**
 * @implements CommandHandlerInterface<Command>
 */
final readonly class Handler implements CommandHandlerInterface
{
    public function __construct(
        private LoanRepository $repository,
        private FlusherInterface $flusher,
        private ValidationInterface $validator,
    ) {
    }

    /**
     * @param Command $command
     */
    public function handle(CommandInterface $command): void
    {
        $this->validator->validate($command);

        $rate = new Rate($command->interestRate);
        $loan = Loan::create(
            id: new Id($command->id),
            clientId: new Id($command->clientId),
            name: new Name($command->name),
            term: new Term($command->term),
            interestRate: $rate->calculateInterestRate(State::from($command->state)),
            amount: new Amount($command->amount),
        );

        $this->repository->add($loan);
        $this->flusher->flush();
    }
}
