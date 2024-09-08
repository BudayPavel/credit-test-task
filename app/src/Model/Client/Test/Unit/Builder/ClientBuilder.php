<?php

declare(strict_types=1);

namespace App\Model\Client\Test\Unit\Builder;

use App\Model\Client\Entity\Client\Address;
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

final readonly class ClientBuilder
{
    public const TEST_ID = 'f2172e32-78f4-122a-3408-4a4f4b865ef1';
    public const TEST_EMAIL = 'test@test.com';
    public const TEST_NAME = 'Test name';
    public const TEST_AGE = 18;
    public const TEST_CITY = 'Test city';
    public const TEST_ZIP_CODE = '2200112';
    public const TEST_PHONE = '+1 222 334 33 44';
    public const TEST_FICO_SCORE = 500;
    public const TEST_SSN = 'TEST123';
    public const TEST_MONTHLY_INCOME = 1500;

    private function __construct(
        private Id $id,
        private Email $email,
        private Name $firstName,
        private Name $lastName,
        private Age $age,
        private Address $address,
        private Phone $phone,
        private FicoScore $ficoScore,
        private Number $ssn,
        private Quantity $monthlyIncome,
    ) {
    }

    public static function create(): self
    {
        return new self(
            id: new Id(self::TEST_ID),
            email: new Email(self::TEST_EMAIL),
            firstName: new Name(self::TEST_NAME),
            lastName: new Name(self::TEST_NAME),
            age: new Age(self::TEST_AGE),
            address: new Address(
                city: new City(self::TEST_CITY),
                zipCode: new ZipCode(self::TEST_ZIP_CODE),
                state: State::CA,
            ),
            phone: new Phone(self::TEST_PHONE),
            ficoScore: new FicoScore(self::TEST_FICO_SCORE),
            ssn: new Number(self::TEST_SSN),
            monthlyIncome: new Quantity(self::TEST_MONTHLY_INCOME),
        );
    }

    public function buildClient(): Client
    {
        return Client::create(
            id: $this->id,
            email: $this->email,
            firstName: $this->firstName,
            lastName: $this->lastName,
            age: $this->age,
            address: $this->address,
            phone: $this->phone,
            ficoScore: $this->ficoScore,
            ssn: $this->ssn,
            monthlyIncome: $this->monthlyIncome,
        );
    }
}
