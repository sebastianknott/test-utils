<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\Test\Unit\SystemUnderTest\Mockery;

use Sebastianknott\TestUtils\SystemUnderTest\Mockery\MockeryBundle;
use Sebastianknott\TestUtils\SystemUnderTest\Mockery\MockeryBundleFactory;
use Sebastianknott\TestUtils\TestCase\TestToolsCase;

class MockeryBundleFactoryTest extends TestToolsCase
{
    public function testBuild(): void
    {
        $class   = new class {
        };
        $factory = new MockeryBundleFactory();
        $bundle  = $factory->build($class, ['foo' => 'bar']);

        self::assertSame($class, $bundle->getSut());
        self::assertSame($class, $bundle->sut);
        self::assertSame(['foo' => 'bar'], $bundle->getArrayCopy());
        self::assertInstanceOf(MockeryBundle::class, $bundle);
    }
}
