<?php

declare(strict_types=1);

namespace App\Service\Paginator;

use Countable;

interface PaginateItemInterface extends Countable
{
    public function getItems(): iterable;
    public function getItemNumberPerPage(): int;
    public function count(): int;
    public function getTotalItemCount(): int;
    public function getCurrentPageNumber(): int;
    public function response(): array;
}
