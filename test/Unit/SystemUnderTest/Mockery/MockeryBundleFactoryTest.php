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
        // @phpstan-igonre-next-line
        self::assertSame(['foo' => 'bar'], $bundle->getArrayCopy());
        // @phpstan-ignore staticMethod.alreadyNarrowedType
        self::assertInstanceOf(MockeryBundle::class, $bundle);
    }
}
