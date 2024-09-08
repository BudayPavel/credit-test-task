<?php

declare(strict_types=1);

namespace App\Model\Loan\Command\Create;

use App\Model\Loan\Entity\VO\State;
use App\Service\CommandHandler\CommandInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class Command implements CommandInterface
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Uuid]
        public string $id,
        #[Assert\NotBlank]
        #[Assert\Uuid]
        public string $clientId,
        #[Assert\NotBlank]
        public string $name,
        #[Assert\NotBlank]
        public int $term,
        #[Assert\NotBlank]
        #[Assert\Choice(callback: [State::class, 'getCases'], message: 'State is not valid.')]
        public int $state,
        #[Assert\NotBlank]
        public float $interestRate,
        #[Assert\NotBlank]
        public float $amount,
    ) {
    }
}
