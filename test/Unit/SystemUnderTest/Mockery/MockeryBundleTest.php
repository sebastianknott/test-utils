<?php

namespace Sebastianknott\TestUtils\Test\Unit\SystemUnderTest\Mockery;

use Sebastianknott\TestUtils\SystemUnderTest\Bundle;
use Sebastianknott\TestUtils\SystemUnderTest\Mockery\MockeryBundle;
use Sebastianknott\TestUtils\TestCase\TestToolsCase;

class MockeryBundleTest extends TestToolsCase
{
    public function testParent(): void
    {
        $sut    = new class {
        };
        $bundle = new MockeryBundle($sut, []);
        self::assertInstanceOf(Bundle::class, $bundle);
    }
}
