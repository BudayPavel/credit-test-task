<?php

declare(strict_types=1);

namespace App\Model\Client\Entity\VO;

enum StateValue: string
{
    case CA = 'CA';
    case NY = 'NY';
    case NV = 'NV';
}
