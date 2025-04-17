<?php

namespace Sebastianknott\TestUtils\Test\Unit\SystemUnderTest\Prophecy;

use Prophecy\Prophet;
use Sebastianknott\TestUtils\SystemUnderTest\Phake\PhakeBundle;
use Sebastianknott\TestUtils\SystemUnderTest\Phake\PhakeBundleFactory;
use Sebastianknott\TestUtils\SystemUnderTest\Prophecy\ProphecyBundle;
use Sebastianknott\TestUtils\SystemUnderTest\Prophecy\ProphecyBundleFactory;
use PHPUnit\Framework\TestCase;
use Sebastianknott\TestUtils\TestCase\TestToolsCase;

class ProphecyBundleFactoryTest extends TestToolsCase
{
    public function testBuild()
    {
        $prophet = new Prophet();
        $prophecyProphet = $prophet->prophesize(Prophet::class);
        $mockedProphet = $prophecyProphet->reveal();

        $class = new class {
        };
        $factory = new ProphecyBundleFactory($mockedProphet);
        $bundle = $factory->build($class, ['foo' => 'bar']);

        self::assertSame($class, $bundle->getSut());
        self::assertSame($class, $bundle->sut);
        self::assertSame(['foo' => 'bar'], $bundle->getArrayCopy());
        self::assertInstanceOf(ProphecyBundle::class, $bundle);
        self::assertSame($bundle->prophet, $mockedProphet);
    }
}
