<?php

declare(strict_types=1);

namespace App\Model\Client\Query\FindClient;

final readonly class QueryClient
{
    public function __construct(
        public string $id,
        public string $firstName,
        public string $lastName,
        public int $age,
        public int $state,
        public string $city,
        public string $zipCode,
        public string $ssn,
        public int $ficoScore,
        public string $email,
        public string $phone,
        public ?float $monthlyIncome,
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'age' => $this->age,
            'state' => $this->state,
            'city' => $this->city,
            'zip_code' => $this->zipCode,
            'ssn' => $this->ssn,
            'fico_score' => $this->ficoScore,
            'email' => $this->email,
            'phone' => $this->phone,
            'monthly_income' => $this->monthlyIncome,
        ];
    }
}
