<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\Test\Unit\SystemUnderTest\Prophecy;

use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophet;
use Sebastianknott\TestUtils\SystemUnderTest\Prophecy\ProphecyFactory;
use Sebastianknott\TestUtils\TestCase\TestToolsCase;

class ProphecyFactoryTest extends TestToolsCase
{
    public function testBuildReturnsMock(): void
    {
        $mockedProphet   = mock(Prophet::class);
        $prophecizedSelf = mock(ObjectProphecy::class);
        $mockedSelf      = mock(self::class);

        $mockedProphet->expects()->prophesize(self::class)->andReturn($prophecizedSelf);
        $prophecizedSelf->expects()->reveal()->andReturn($mockedSelf);

        $subject = new ProphecyFactory($mockedProphet);
        $result  = $subject->build(self::class);

        assertThat(
            $result,
            allOf(
                hasKeyValuePair('controlObject', anInstanceOf(ObjectProphecy::class)),
                hasKeyValuePair('mockObject', anInstanceOf(self::class)),
            ),
        );
    }
}
