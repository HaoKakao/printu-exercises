<?php
declare(strict_types=1);
require_once __DIR__ . '/../vendor/autoload.php';

use Printu\Exercises\UniqueString;
use PHPUnit\Framework\TestCase;

final class UniqueStringTest extends TestCase
{
    /**
     * @test
     */
    public function testValidString(): void
    {
        $this->assertSame(3, UniqueString::findUniqueString('hashthegame'));
        $this->assertSame(3, UniqueString::findUniqueString('statistics'));
        $this->assertSame(1, UniqueString::findUniqueString('printu'));
        $this->assertSame(1, UniqueString::findUniqueString('bartlomiejwrzesien'));
        $this->assertSame(-1, UniqueString::findUniqueString('aa'));
    }

    /**
     * @test
     */
    public function testInvalidCharacters(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("String abc123 does not match regex.");

        UniqueString::findUniqueString('abc123');
    }

    /**
     * @test
     */
    public function testInvalidLength(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("String a must be longer than " . UniqueString::MIN_LENGTH . " and less than " . UniqueString::MAX_LENGTH . " characters.");

        UniqueString::findUniqueString('a');
    }
}
