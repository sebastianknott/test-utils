<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\Test\Unit\SystemUnderTest\Prophecy;

use Mockery\LegacyMockInterface;
use Mockery\MockInterface;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophet;
use Sebastianknott\TestUtils\SystemUnderTest\Prophecy\ProphecyFactory;
use Sebastianknott\TestUtils\TestCase\TestToolsCase;

class ProphecyFactoryTest extends TestToolsCase
{
    public function testBuildReturnsMock(): void
    {
        /** @var Prophet&(MockInterface&object&LegacyMockInterface) $mockedProphet */
        $mockedProphet   = mock(Prophet::class);
        $prophesizedSelf = mock(ObjectProphecy::class);
        $mockedSelf      = mock(self::class);

        $mockedProphet->expects()->prophesize(self::class)->andReturn($prophesizedSelf);
        $prophesizedSelf->expects()->reveal()->andReturn($mockedSelf);

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
