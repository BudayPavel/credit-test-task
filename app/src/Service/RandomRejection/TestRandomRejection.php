<?php

declare(strict_types=1);

namespace App\Service\RandomRejection;

class TestRandomRejection implements RandomRejectionInterface
{
    public function rand(): bool
    {
       return true;
    }
}
