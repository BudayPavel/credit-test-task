<?php

declare(strict_types=1);

namespace App\Model\Client\Command\Create;

use App\Service\Request\BodyRequestInterface;
use Symfony\Component\Serializer\Annotation\SerializedName;

final readonly class Request implements BodyRequestInterface
{
    public function __construct(
        public string $email,
        #[SerializedName(serializedName: 'first_name')]
        public string $firstName,
        #[SerializedName(serializedName: 'last_name')]
        public string $lastName,
        public int $age,
        public string $city,
        #[SerializedName(serializedName: 'zip_code')]
        public string $zipCode,
        public int $state,
        public string $phone,
        #[SerializedName(serializedName: 'fico_score')]
        public int $ficoScore,
        public string $ssn,
    ) {
    }
}
