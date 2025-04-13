<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\Test\Unit\SystemUnderTest;

use PHPUnit\Framework\TestCase;
use Sebastianknott\TestUtils\SystemUnderTest\Bundle;

class BundleTest extends TestCase
{
    public function testGetSut(): void
    {
        $sut    = new class {
        };
        $bundle = new Bundle($sut, []);
        self::assertSame($sut, $bundle->getSut());
        self::assertSame($sut, $bundle->sut);
    }

    public function testGetParameters(): void
    {
        $sut    = new class {
        };
        $bundle = new Bundle($sut, ['foo' => 'bar']);
        self::assertSame(['foo' => 'bar'], $bundle->getArrayCopy());
    }
}
