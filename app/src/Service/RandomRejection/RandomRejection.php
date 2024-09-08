<?php

declare(strict_types=1);

namespace App\Service\RandomRejection;

class RandomRejection implements RandomRejectionInterface
{
    public function rand(): bool
    {
        return random_int(0, 1) === 0;
    }
}
