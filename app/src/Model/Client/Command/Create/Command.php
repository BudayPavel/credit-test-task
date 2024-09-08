<?php

declare(strict_types=1);

namespace App\Model\Client\Command\Create;

use App\Model\Client\Entity\VO\FicoScore;
use App\Model\Client\Entity\VO\State;
use App\Service\CommandHandler\CommandInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\SerializedName;

final class Command implements CommandInterface
{
    #[Assert\NotBlank]
    #[Assert\Uuid]
    public string $id;

    #[Assert\NotBlank]
    public string $firstName;

    #[Assert\NotBlank]
    public string $lastName;

    #[Assert\NotBlank]
    public int $age;

    #[Assert\NotBlank]
    #[Assert\Choice(callback: [State::class, 'getCases'], message: 'State is not valid.')]
    public int $state;

    #[Assert\NotBlank]
    public string $city;

    #[Assert\NotBlank]
    public string $zipCode;

    #[Assert\NotBlank]
    public string $ssn;

    #[Assert\NotBlank]
    #[Assert\Range(min: FicoScore::MIN, max: FicoScore::MAX)]
    public int $ficoScore;

    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;

    #[Assert\NotBlank]
    public string $phone;

    #[SerializedName(serializedName: 'monthly_income')]
    public ?float $monthlyIncome = null;

    public function __construct(
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
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;
        $this->state = $state;
        $this->city = $city;
        $this->zipCode = $zipCode;
        $this->ssn = $ssn;
        $this->ficoScore = $ficoScore;
        $this->email = $email;
        $this->phone = $phone;
    }
}
