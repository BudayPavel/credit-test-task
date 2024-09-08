<?php

declare(strict_types=1);

namespace App\Model\Client\Test\Unit\VO;

use App\Model\Client\Entity\VO\Phone;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Model\Client\Entity\VO\Phone
 *
 * @internal
 */
final class PhoneTest extends TestCase
{
    public function testSuccess(): void
    {
        $phone = new Phone($value = '123456789');

        self::assertEquals($value, $phone->getValue());
    }

    public function testIncorrectString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Phone('test');
    }

    public function testIncorrect(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Phone('1-23-4567\89');
    }

    public function testEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Phone('');
    }
}
