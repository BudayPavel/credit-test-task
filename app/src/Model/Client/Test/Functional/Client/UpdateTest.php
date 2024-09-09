<?php

declare(strict_types=1);

namespace App\Model\Client\Test\Functional\Client;

use App\Model\Client\Test\Functional\DataFixtures\ClientTestFixtures;
use App\Tests\DbWebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * @covers \App\Model\Client\Controller\Client\UpdateController::__invoke
 */
final class UpdateTest extends DbWebTestCase
{
    public function testUpdateClient(): void
    {
        $client = static::createClient();
        $updatedContent = ClientTestFixtures::getUpdatedContent();
        $client->request(
            method: 'PUT',
            uri: sprintf('/client/%s/update', ClientTestFixtures::TEST_UUID),
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode($updatedContent, JSON_THROW_ON_ERROR),
        );

        $this->assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode(),
            $client->getResponse()->getContent(),
        );
        $this->assertJson($content = $client->getResponse()->getContent());

        $data = json_decode($content, true, 512, JSON_THROW_ON_ERROR);

        self::assertArrayHasKey('id', $data);

        $client->request(
            method: 'GET',
            uri: sprintf('/client/%s', ClientTestFixtures::TEST_UUID),
        );

        $this->assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode(),
            $client->getResponse()->getContent(),
        );
        $this->assertJson($content = $client->getResponse()->getContent());

        $data = json_decode($content, true, 512, JSON_THROW_ON_ERROR);

        self::assertSame($updatedContent['age'], $data['age']);
        self::assertSame($updatedContent['monthly_income'], $data['monthly_income']);
        self::assertSame($updatedContent['state'], $data['state']);
    }

    public function testUpdateNotFoundClient(): void
    {
        $client = static::createClient();
        $client->request(
            method: 'PUT',
            uri: sprintf('/client/%s/update', ClientTestFixtures::TEST_NOT_FOUND_UUID),
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode(ClientTestFixtures::getUpdatedContent(), JSON_THROW_ON_ERROR),
        );

        $this->assertSame(
            Response::HTTP_NOT_FOUND,
            $client->getResponse()->getStatusCode(),
            $client->getResponse()->getContent(),
        );
        $this->assertJson($content = $client->getResponse()->getContent());

        $data = json_decode($content, true, 512, JSON_THROW_ON_ERROR);

        self::assertIsArray($data);
    }
}
