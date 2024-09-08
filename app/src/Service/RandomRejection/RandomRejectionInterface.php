<?php

declare(strict_types=1);

namespace App\Service\RandomRejection;

interface RandomRejectionInterface
{
    public function rand(): bool;
}
