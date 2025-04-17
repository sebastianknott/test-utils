<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\Test\Unit\SystemUnderTest;

use Sebastianknott\TestUtils\SystemUnderTest\Bundle;
use Sebastianknott\TestUtils\TestCase\TestToolsCase;

class BundleTest extends TestToolsCase
{
    public function testGetSut(): void
    {
        $sut    = new class {
        };
        $bundle = new class ($sut, []) extends Bundle {
        };
        self::assertSame($sut, $bundle->getSut());
        self::assertSame($sut, $bundle->sut);
    }

    public function testGetParameters(): void
    {
        $sut    = new class {
        };
        $bundle = new class ($sut, ['foo' => 'bar']) extends Bundle {
        };
        self::assertSame(['foo' => 'bar'], $bundle->getArrayCopy());
    }
}
