<?php

declare(strict_types=1);

namespace App\Model\Client\Test\Functional\DataFixtures;

use App\Model\Client\Command\Create\Command;
use App\Model\Client\Command\Create\Handler;
use App\Model\Client\Entity\VO\Age;
use App\Model\Client\Entity\VO\FicoScore;
use App\Model\Client\Entity\VO\State;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

final class ClientTestFixtures extends Fixture implements FixtureGroupInterface
{
    public const TEST_UUID = 'f2172e32-78f4-122a-3408-4a4f4b865ef1';
    public const TEST_NOT_FOUND_UUID = '2486c513-d362-47c3-b2dc-e169474f6f43';
    public const TEST_EMAIL = 'test@test.com';
    public const TEST_FIRST_NAME = 'Test first name';
    public const TEST_LAST_NAME = 'Test last name';
    public const TEST_AGE = 18;
    public const TEST_STATE = 1;
    public const TEST_CITY = 'Test city';
    public const TEST_ZIP_CODE = '2200112';
    public const TEST_PHONE = '+1 222 334 33 44';
    public const TEST_FICO_SCORE = 400;
    public const TEST_SSN = 'TEST123';
    public const TEST_MONTHLY_INCOME = 1000;
    public const TEST_PROJECT_LIST_NUM_PAGE = 1;
    public const TEST_PROJECT_LIST_NUM_PER_PAGE = 10;

    private readonly Generator $factory;

    public function __construct(private readonly Handler $handler)
    {
        $this->factory = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        $this->handler->handle(new Command(
            id: self::TEST_UUID,
            firstName: $this->factory->firstName,
            lastName: $this->factory->lastName,
            age: $this->factory->numberBetween(Age::MIN, Age::MAX),
            state: State::CA->value,
            city: $this->factory->city,
            zipCode: $this->factory->postcode,
            ssn: self::TEST_SSN,
            ficoScore: $this->factory->numberBetween(FicoScore::MIN, FicoScore::MAX),
            email: $this->factory->email,
            phone: $this->factory->phoneNumber,
        ));
    }

    public static function getCreatedContent(): array
    {
        return [
            'first_name' => self::TEST_FIRST_NAME,
            'last_name' => self::TEST_LAST_NAME,
            'age' => self::TEST_AGE,
            'state' => self::TEST_STATE,
            'city' => self::TEST_CITY,
            'zip_code' => self::TEST_ZIP_CODE,
            'ssn' => self::TEST_SSN,
            'fico_score' => self::TEST_FICO_SCORE,
            'email' => self::TEST_EMAIL,
            'phone' => self::TEST_PHONE,
            'monthly_income' => self::TEST_MONTHLY_INCOME,
        ];
    }

    public static function getUpdatedContent(): array
    {
        return [
            'age' => self::TEST_AGE + 1,
            'monthly_income' => self::TEST_MONTHLY_INCOME + 200,
            'state' => State::NV->value,
        ];
    }

    public static function getGroups(): array
    {
        return ['test'];
    }
}
