<?php

declare(strict_types=1);

namespace App\Model\Client\Query\FindClient;

use App\Model\Client\Entity\VO\Id;
use App\Service\CommandHandler\QueryInterface;

final readonly class Query implements QueryInterface
{
    public function __construct(public Id $id)
    {
    }
}
