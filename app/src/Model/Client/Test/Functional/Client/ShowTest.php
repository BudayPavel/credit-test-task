<?php

declare(strict_types=1);

namespace App\Model\Client\Test\Functional\Client;

use App\Model\Client\Test\Functional\DataFixtures\ClientTestFixtures;
use App\Tests\DbWebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * @covers \App\Model\Client\Controller\Client\ShowController::__invoke
 */
final class ShowTest extends DbWebTestCase
{
    public function testShowClient(): void
    {
        $this->client->request(
            method: 'GET',
            uri: sprintf('/client/%s', ClientTestFixtures::TEST_UUID),
        );

        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode(),
            $this->client->getResponse()->getContent(),
        );
        $this->assertJson($content = $this->client->getResponse()->getContent());

        $data = json_decode($content, true, 512, JSON_THROW_ON_ERROR);

        self::assertArrayHasKey('id', $data);
    }

    public function testShowNotFoundClient(): void
    {
        $this->client->request(
            method: 'GET',
            uri: sprintf('/client/%s', ClientTestFixtures::TEST_NOT_FOUND_UUID),
        );

        $this->assertSame(
            Response::HTTP_NOT_FOUND,
            $this->client->getResponse()->getStatusCode(),
            $this->client->getResponse()->getContent(),
        );
        $this->assertJson($content = $this->client->getResponse()->getContent());

        $data = json_decode($content, true, 512, JSON_THROW_ON_ERROR);

        self::assertIsArray($data);
    }
}
