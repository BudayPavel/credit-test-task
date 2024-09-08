<?php

declare(strict_types=1);

namespace App\Model\Loan\Test\Functional\DataFixtures;

use App\Model\Loan\Command\Create\Command;
use App\Model\Loan\Command\Create\Handler;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

final class LoanTestFixtures extends Fixture implements FixtureGroupInterface
{
    public const TEST_UUID = 'f3272e32-78f4-122a-3408-4a4f4b865ef1';
    public const TEST_NOT_FOUND_UUID = '2486c513-d362-47c3-b2dc-e169474f6f43';
    public const TEST_CLIENT_UUID = 'f2172e32-78f4-122a-3408-4a4f4b865ef1';
    public const TEST_NAME = 'Test name';
    public const TEST_TERM = 20;
    public const TEST_RATE = 12;
    public const TEST_AMOUNT = 1200;


    private readonly Generator $factory;

    public function __construct(private readonly Handler $handler)
    {
        $this->factory = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        $command = new Command(
            id: self::TEST_UUID,
            clientId: self::TEST_CLIENT_UUID,
            name: $this->factory->name,
            term: $this->factory->numberBetween(10,20),
            interestRate: self::TEST_RATE,
            amount: self::TEST_AMOUNT,
        );

        $this->handler->handle($command);
    }

    public static function getCreatedContent(): array
    {
        return [
            'client_id' => self::TEST_CLIENT_UUID,
            'name' => self::TEST_NAME,
            'term' => self::TEST_TERM,
            'interest_rate' => self::TEST_RATE,
            'amount' => self::TEST_AMOUNT,
        ];
    }

    public static function getGroups(): array
    {
        return ['test'];
    }
}
