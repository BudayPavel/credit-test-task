<?php

declare(strict_types=1);

namespace App\Model\Client\Entity\Client;

use App\Model\Client\Entity\VO\City;
use App\Model\Client\Entity\VO\State;
use App\Model\Client\Entity\VO\ZipCode;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Address
{
    #[ORM\Column(type: City::NAME, length: City::MAX_LENGTH)]
    private readonly City $city;

    #[ORM\Column(type: ZipCode::NAME, length: ZipCode::MAX_LENGTH)]
    private readonly ZipCode $zipCode;

    #[ORM\Column(type: State::NAME)]
    private readonly State $state;

    public function __construct(City $city, ZipCode $zipCode, State $state)
    {
        $this->city = $city;
        $this->state = $state;
        $this->zipCode = $zipCode;
    }
}