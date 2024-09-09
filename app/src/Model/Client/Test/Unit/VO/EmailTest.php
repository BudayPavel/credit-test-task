<?php

declare(strict_types=1);

namespace App\Model\Client\Test\Unit\VO;

use App\Model\Client\Entity\VO\Email;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Model\Client\Entity\VO\Email
 *
 * @internal
 */
final class EmailTest extends TestCase
{
    public function testSuccess(): void
    {
        $email = new Email($value = 'email@app.test');

        self::assertEquals($value, $email->getValue());
    }

    public function testIncorrect(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Email('not-email');
    }

    public function testEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Email('');
    }
}
