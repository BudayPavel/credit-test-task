<?php

declare(strict_types=1);

namespace App\Model\Loan\Command\Create;

use App\Service\Request\BodyRequestInterface;
use Symfony\Component\Serializer\Annotation\SerializedName;

final readonly class Request implements BodyRequestInterface
{
    public function __construct(
        #[SerializedName(serializedName: 'client_id')]
        public string $clientId,
        public string $name,
        public int $term,
        #[SerializedName(serializedName: 'interest_rate')]
        public float $interestRate,
        public float $amount,
    ) {
    }
}
