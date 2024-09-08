<?php

declare(strict_types=1);

namespace App\Model\Client\Command\Edit;

use App\Model\Client\Entity\VO\FicoScore;
use App\Model\Client\Entity\VO\State;
use App\Service\CommandHandler\CommandInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\SerializedName;

final class Command implements CommandInterface
{
    #[SerializedName(serializedName: 'monthly_income')]
    public ?float $monthlyIncome = null;

    public function __construct(
        #[Assert\NotBlank]
        public string $id,
        #[SerializedName(serializedName: 'first_name')]
        #[Assert\NotBlank]
        public string $firstName,
        #[SerializedName(serializedName: 'first_name')]
        #[Assert\NotBlank]
        public string $lastName,
        #[Assert\NotBlank]
        public int $age,
        #[Assert\NotBlank]
        #[Assert\Choice(callback: [State::class, 'getCases'], message: 'State is not valid.')]
        public int $state,
        #[Assert\NotBlank]
        public string $city,
        #[SerializedName(serializedName: 'zip_code')]
        #[Assert\NotBlank]
        public string $zipCode,
        #[Assert\NotBlank]
        public string $ssn,
        #[SerializedName(serializedName: 'fico_score')]
        #[Assert\NotBlank]
        #[Assert\Range(min: FicoScore::MIN, max: FicoScore::MAX)]
        public int $ficoScore,
        #[Assert\NotBlank]
        #[Assert\Email]
        public string $email,
        #[Assert\NotBlank]
        public string $phone,
    ) {
    }

    public static function fromClient(
        string $id,
        string $firstName,
        string $lastName,
        int $age,
        int $state,
        string $city,
        string $zipCode,
        string $ssn,
        int $ficoScore,
        string $email,
        string $phone,
        ?float $monthlyIncome,
    ): self {
        $command = new self(
            id: $id,
            firstName: $firstName,
            lastName: $lastName,
            age: $age,
            state: $state,
            city: $city,
            zipCode: $zipCode,
            ssn: $ssn,
            ficoScore: $ficoScore,
            email: $email,
            phone: $phone,
        );
        $command->monthlyIncome = $monthlyIncome;
        return $command;
    }
}
