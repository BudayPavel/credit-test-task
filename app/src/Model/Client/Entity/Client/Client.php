<?php

declare(strict_types=1);

namespace App\Model\Client\Entity\Client;

use App\Model\Client\Entity\VO\Age;
use App\Model\Client\Entity\VO\Email;
use App\Model\Client\Entity\VO\FicoScore;
use App\Model\Client\Entity\VO\Id;
use App\Model\Client\Entity\VO\Name;
use App\Model\Client\Entity\VO\Number;
use App\Model\Client\Entity\VO\Phone;
use App\Model\Client\Entity\VO\Quantity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: self::TABLE)]
class Client
{
    public const TABLE = 'clients';

    #[ORM\Column(type: Quantity::NAME, precision: 10, scale: 2, nullable: true)]
    private ?Quantity $monthlyIncome = null;

    private function __construct(
        #[ORM\Column(type: Id::NAME)]
        #[ORM\Id]
        private readonly Id $id,
        #[ORM\Column(type: Email::NAME)]
        private Email $email,
        #[ORM\Column(type: Name::NAME)]
        private Name $firstName,
        #[ORM\Column(type: Name::NAME)]
        private Name $lastName,
        #[ORM\Column(type: Age::NAME)]
        private Age $age,
        #[ORM\Embedded(class: Address::class)]
        private Address $address,
        #[ORM\Column(type: Phone::NAME)]
        private Phone $phone,
        #[ORM\Column(type: FicoScore::NAME)]
        private FicoScore $ficoScore,
        #[ORM\Column(type: Number::NAME, length: Number::MAX_LENGTH)]
        private Number $ssn,
    ) {
    }

    public static function create(
        Id $id,
        Email $email,
        Name $firstName,
        Name $lastName,
        Age $age,
        Address $address,
        Phone $phone,
        FicoScore $ficoScore,
        Number $ssn,
        ?Quantity $monthlyIncome,
    ): self {
        $client = new self(
            id: $id,
            email: $email,
            firstName: $firstName,
            lastName: $lastName,
            age: $age,
            address: $address,
            phone: $phone,
            ficoScore: $ficoScore,
            ssn: $ssn,
        );
        $client->monthlyIncome = $monthlyIncome;

        return $client;
    }

    public function edit(
        Email $email,
        Name $firstName,
        Name $lastName,
        Age $age,
        Address $address,
        Phone $phone,
        FicoScore $ficoScore,
        Number $ssn,
        ?Quantity $monthlyIncome,
    ): void {
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;
        $this->address = $address;
        $this->phone = $phone;
        $this->ficoScore = $ficoScore;
        $this->ssn = $ssn;
        $this->monthlyIncome = $monthlyIncome;
    }
}
