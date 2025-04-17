<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\Test\Unit\SystemUnderTest\Mockery;

use Mockery\MockInterface;
use Sebastianknott\TestUtils\SystemUnderTest\Mockery\MockeryFactory;
use Sebastianknott\TestUtils\TestCase\TestToolsCase;

class MockeryFactoryTest extends TestToolsCase
{
    public function testBuildReturnsMock(): void
    {
        $subject = new MockeryFactory();
        $result = $subject->build(self::class);

        assertThat(
            $result,
            allOf(
                hasKeyValuePair(
                    'controlObject',
                    allOf(anInstanceOf(MockInterface::class), anInstanceOf(self::class))
                ),
                hasKeyValuePair(
                    'mockObject',
                    allOf(anInstanceOf(MockInterface::class), anInstanceOf(self::class))
                )
            )
        );
    }
}
