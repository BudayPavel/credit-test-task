<?php

declare(strict_types=1);

namespace App\Model\Client\Command\Edit;

use App\Model\Client\Entity\VO\Age;
use App\Model\Client\Entity\VO\City;
use App\Model\Client\Entity\VO\Email;
use App\Model\Client\Entity\VO\FicoScore;
use App\Model\Client\Entity\VO\Id;
use App\Model\Client\Entity\VO\Name;
use App\Model\Client\Entity\VO\Number;
use App\Model\Client\Entity\VO\Phone;
use App\Model\Client\Entity\VO\Quantity;
use App\Model\Client\Entity\VO\State;
use App\Model\Client\Entity\VO\ZipCode;
use App\Model\Client\Entity\Client\Address;
use App\Model\Client\Entity\Client\ClientRepository;
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
        private ClientRepository $repository,
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

        $client = $this->repository->get(new Id($command->id));
        $client->edit(
            email: new Email($command->email),
            firstName: new Name($command->firstName),
            lastName: new Name($command->lastName),
            age: new Age($command->age),
            address: new Address(
                city: new City($command->city),
                zipCode: new ZipCode($command->zipCode),
                state: State::from($command->state),
            ),
            phone: new Phone($command->phone),
            ficoScore: new FicoScore($command->ficoScore),
            ssn: new Number($command->ssn),
            monthlyIncome: $command->monthlyIncome ? new Quantity($command->monthlyIncome) : null,
        );

        $this->flusher->flush();
    }
}
