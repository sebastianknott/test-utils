<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\Test\Unit\SystemUnderTest\Phake;

use Phake\IMock;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Sebastianknott\TestUtils\SystemUnderTest\Phake\PhakeFactory;
use Sebastianknott\TestUtils\TestCase\TestToolsCase;

class PhakeFactoryTest extends TestToolsCase
{
    public function testBuildReturnsMock(): void
    {
        $subject = new PhakeFactory();
        $result = $subject->build(self::class);

        assertThat(
            $result,
            allOf(
                hasKeyValuePair(
                    'controlObject',
                    allOf(anInstanceOf(IMock::class), anInstanceOf(self::class))
                ),
                hasKeyValuePair(
                    'mockObject',
                    allOf(anInstanceOf(IMock::class), anInstanceOf(self::class))
                )
            )
        );
    }
}
