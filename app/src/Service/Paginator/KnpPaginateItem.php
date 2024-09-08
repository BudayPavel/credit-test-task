<?php

declare(strict_types=1);

namespace App\Service\Paginator;

use Knp\Component\Pager\Pagination\PaginationInterface;

final readonly class KnpPaginateItem implements PaginateItemInterface
{
    public function __construct(private PaginationInterface $paginator)
    {
    }

    public function getItems(): iterable
    {
        return $this->paginator->getItems();
    }

    public function getTotalItemCount(): int
    {
        return $this->paginator->getTotalItemCount();
    }

    public function getItemNumberPerPage(): int
    {
        return $this->paginator->getItemNumberPerPage();
    }

    public function getCurrentPageNumber(): int
    {
        return $this->paginator->getCurrentPageNumber();
    }

    public function count(): int
    {
        return count($this->getItems());
    }

    public function response(): array
    {
        return [
            'items' => $this->getItems(),
            'pagination' => [
                'count' => $this->count(),
                'total' => $this->getTotalItemCount(),
                'per_page' => $this->getItemNumberPerPage(),
                'page' => $this->getCurrentPageNumber(),
                'pages' => ceil($this->getTotalItemCount() / $this->getItemNumberPerPage()),
            ],
        ];
    }
}
