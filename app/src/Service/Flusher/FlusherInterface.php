<?php

declare(strict_types=1);

namespace App\Service\Flusher;

interface FlusherInterface
{
    public function flush(): void;
}
