<?php

declare(strict_types=1);

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
        // @phpstan-ignore staticMethod.alreadyNarrowedType
        self::assertInstanceOf(Bundle::class, $bundle);
    }
}
