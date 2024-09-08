<?php

declare(strict_types=1);

namespace App\Model\Client\Test\Functional\Client;

use App\Model\Client\Test\Functional\DataFixtures\ClientTestFixtures;
use App\Tests\DbWebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * @covers \App\Model\Client\Controller\Client\CreateController::__invoke
 */
final class CreateTest extends DbWebTestCase
{
    public function testCreateClient(): void
    {
        $this->client->request(
            method: 'POST',
            uri: '/client/create',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode(ClientTestFixtures::getCreatedContent(), JSON_THROW_ON_ERROR),
        );

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertJson($content = $this->client->getResponse()->getContent());

        $data = json_decode($content, true, 512, JSON_THROW_ON_ERROR);

        self::assertArrayHasKey('id', $data);
    }

    public function testErrorCreateClientIncorrectUrl(): void
    {
        $this->client->request(
            method: 'POST',
            uri: '/client/create/',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode(ClientTestFixtures::getCreatedContent(), JSON_THROW_ON_ERROR),
        );

        $this->assertSame(Response::HTTP_NOT_FOUND, $this->client->getResponse()->getStatusCode());
        $this->assertJson($content = $this->client->getResponse()->getContent());

        $data = json_decode($content, true, 512, JSON_THROW_ON_ERROR);

        self::assertIsArray($data);
    }

    public function testErrorCreateClientBadContent(): void
    {
        $this->client->request(
            method: 'POST',
            uri: '/client/create',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode([...ClientTestFixtures::getCreatedContent(), ...['phone' => 'test']], JSON_THROW_ON_ERROR),
        );

        $this->assertSame(Response::HTTP_BAD_REQUEST, $this->client->getResponse()->getStatusCode());
        $this->assertJson($content = $this->client->getResponse()->getContent());

        $data = json_decode($content, true, 512, JSON_THROW_ON_ERROR);

        self::assertIsArray($data);
    }
}
