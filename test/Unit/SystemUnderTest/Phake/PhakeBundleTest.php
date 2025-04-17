<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\Test\Unit\SystemUnderTest\Phake;

use Sebastianknott\TestUtils\SystemUnderTest\Bundle;
use Sebastianknott\TestUtils\SystemUnderTest\Phake\PhakeBundle;
use Sebastianknott\TestUtils\TestCase\TestToolsCase;

class PhakeBundleTest extends TestToolsCase
{
    public function testParent(): void
    {
        $sut    = new class {
        };
        $bundle = new PhakeBundle($sut, []);
        self::assertInstanceOf(Bundle::class, $bundle);
    }
}
