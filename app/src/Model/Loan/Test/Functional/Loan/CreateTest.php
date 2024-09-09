<?php

declare(strict_types=1);

namespace App\Model\Loan\Test\Functional\Loan;

use App\Model\Loan\Test\Functional\DataFixtures\LoanTestFixtures;
use App\Tests\DbWebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * @covers \App\Model\Loan\Controller\Loan\CreateController::__invoke
 */
final class CreateTest extends DbWebTestCase
{
    public function testCreateLoan(): void
    {
        $client = static::createClient();
        $client->request(
            method: 'POST',
            uri: '/loan/create',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode(LoanTestFixtures::getCreatedContent(), JSON_THROW_ON_ERROR),
        );

        $this->assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode(),
            $client->getResponse()->getContent(),
        );
        $this->assertJson($content = $client->getResponse()->getContent());

        $data = json_decode($content, true, 512, JSON_THROW_ON_ERROR);

        self::assertArrayHasKey('id', $data);
    }

    public function testErrorCreateLoanIncorrectUrl(): void
    {
        $client = static::createClient();
        $client->request(
            method: 'POST',
            uri: '/loan/create/',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode(LoanTestFixtures::getCreatedContent(), JSON_THROW_ON_ERROR),
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

    public function testErrorCreateLoanBadContent(): void
    {
        $client = static::createClient();
        $client->request(
            method: 'POST',
            uri: '/loan/create',
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode([...LoanTestFixtures::getCreatedContent(), ...['name' => '']], JSON_THROW_ON_ERROR),
        );

        $this->assertSame(
            Response::HTTP_BAD_REQUEST,
            $client->getResponse()->getStatusCode(),
            $client->getResponse()->getContent(),
        );
        $this->assertJson($content = $client->getResponse()->getContent());

        $data = json_decode($content, true, 512, JSON_THROW_ON_ERROR);

        self::assertIsArray($data);
    }
}
