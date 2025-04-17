<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\Test\Unit\SystemUnderTest\Prophecy;

use Prophecy\Prophet;
use Sebastianknott\TestUtils\SystemUnderTest\Bundle;
use Sebastianknott\TestUtils\SystemUnderTest\Prophecy\ProphecyBundle;
use Sebastianknott\TestUtils\TestCase\TestToolsCase;

class ProphecyBundleTest extends TestToolsCase
{
    public function testConstruct(): void
    {
        $sut     = new class {
        };
        $prophet = new Prophet();
        $bundle  = new ProphecyBundle($sut, [], $prophet);

        self::assertSame($prophet, $bundle->prophet);
        self::assertInstanceOf(Bundle::class, $bundle);
    }
}
