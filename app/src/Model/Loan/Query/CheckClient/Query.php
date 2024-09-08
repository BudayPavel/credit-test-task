<?php

declare(strict_types=1);

namespace App\Model\Loan\Query\CheckClient;

use App\Model\Loan\Entity\VO\Id;
use App\Service\CommandHandler\QueryInterface;

final readonly class Query implements QueryInterface
{
    public function __construct(public Id $clientId)
    {
    }
}
