<?php

declare(strict_types=1);

namespace App\Model\Client\Entity\Client;

use App\Model\Client\Entity\VO\City;
use App\Model\Client\Entity\VO\State;
use App\Model\Client\Entity\VO\ZipCode;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
readonly class Address
{
    public function __construct(
        #[ORM\Column(type: City::NAME, length: City::MAX_LENGTH)]
        private City $city,
        #[ORM\Column(type: ZipCode::NAME, length: ZipCode::MAX_LENGTH)]
        private ZipCode $zipCode,
        #[ORM\Column(type: State::NAME)]
        private State $state,
    ) {
    }
}
