<?php

declare(strict_types=1);

namespace App\Model\Client\Test\Functional\Client;

use App\Model\Client\Test\Functional\DataFixtures\ClientTestFixtures;
use App\Tests\DbWebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * @covers \App\Model\Client\Controller\Client\ListController::__invoke
 */
final class ListTest extends DbWebTestCase
{
    public function testListClient(): void
    {
        $client = static::createClient();
        $client->request(
            method: 'GET',
            uri: '/client/list',
            parameters: [
                'page' => ClientTestFixtures::TEST_PROJECT_LIST_NUM_PAGE,
                'per_page' => ClientTestFixtures::TEST_PROJECT_LIST_NUM_PER_PAGE
            ]
        );

        $this->assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode(),
            $client->getResponse()->getContent(),
        );
        $this->assertJson($content = $client->getResponse()->getContent());

        $data = json_decode($content, true, 512, JSON_THROW_ON_ERROR);

        self::assertArrayHasKey('items', $data);
        self::assertArrayHasKey('pagination', $data);
        self::assertEquals($data['pagination']['page'], ClientTestFixtures::TEST_PROJECT_LIST_NUM_PAGE);
        self::assertEquals($data['pagination']['per_page'], ClientTestFixtures::TEST_PROJECT_LIST_NUM_PER_PAGE);
    }
}
