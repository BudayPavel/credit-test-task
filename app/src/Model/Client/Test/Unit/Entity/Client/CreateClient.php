<?php

declare(strict_types=1);

namespace App\Model\Client\Test\Unit\Entity\User;

use App\Model\Client\Entity\Client\Client;
use App\Model\Client\Test\Unit\Builder\ClientBuilder;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Model\Client\Entity\Client\Client::create
 * @internal
 */
final class CreateClient extends TestCase
{
    public function testSuccessCreate(): void
    {
        $client = ClientBuilder::create()->buildClient();
        $this->assertInstanceOf(Client::class, $client);
    }
}
