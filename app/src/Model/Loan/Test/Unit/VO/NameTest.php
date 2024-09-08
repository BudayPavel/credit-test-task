<?php

declare(strict_types=1);

namespace App\Model\Loan\Test\Unit\VO;

use App\Model\Loan\Entity\VO\Name;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Model\Client\Entity\VO\Name
 *
 * @internal
 */
final class NameTest extends TestCase
{
    public function testSuccess(): void
    {
        $name = new Name($value = 'Test name');

        self::assertEquals($value, $name->getValue());
    }

    public function testEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Name('');
    }
}
