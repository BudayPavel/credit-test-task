<?php

declare(strict_types=1);

namespace App\Model\Client\Query\FindClientList;

use App\Service\CommandHandler\QueryInterface;
use App\Service\Request\QueryRequestInterface;
use Symfony\Component\Serializer\Annotation\SerializedName;

final readonly class Query implements QueryInterface, QueryRequestInterface
{
    public function __construct(
        public int $page = 1,
        #[SerializedName(serializedName: 'per_page')]
        public int $perPage = 10,
        public ?string $sort = null,
        public ?string $direction = null,
    ) {
    }
}
