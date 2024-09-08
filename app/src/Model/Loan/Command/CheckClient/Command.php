<?php

declare(strict_types=1);

namespace App\Model\Loan\Command\CheckClient;

use App\Model\Company\Constraint\Exist\ClientAge;
use App\Model\Company\Constraint\Exist\ClientFicoScore;
use App\Model\Company\Constraint\Exist\ClientMonthlyIncome;
use App\Model\Company\Constraint\Exist\ClientState;
use App\Model\Loan\Entity\VO\State;
use App\Service\CommandHandler\CommandInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class Command implements CommandInterface
{
    #[Assert\NotBlank]
    public string $email;

    #[Assert\NotBlank]
    public string $phone;

    #[ClientAge]
    public int $age;

    #[Assert\Choice(callback: [State::class, 'getCases'], message: 'State is not valid.')]
    #[ClientState]
    public int $state;

    #[ClientFicoScore]
    public int $ficoScore;

    #[ClientMonthlyIncome]
    public ?float $monthlyIncome = null;

    public function __construct(string $email, string $phone, int $age, int $state, int $ficoScore)
    {
        $this->email = $email;
        $this->phone = $phone;
        $this->age = $age;
        $this->state = $state;
        $this->ficoScore = $ficoScore;
    }

    public static function fromClient(
        string $email,
        string $phone,
        int $age,
        int $state,
        int $ficoScore,
        ?float $monthlyIncome
    ): self {
        $command = new self(email: $email, phone: $phone, age: $age, state: $state, ficoScore: $ficoScore);
        $command->monthlyIncome = $monthlyIncome;
        return $command;
    }
}
