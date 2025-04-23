<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\Test\Unit\SystemUnderTest\Phake;

use Sebastianknott\TestUtils\SystemUnderTest\Phake\PhakeBundle;
use Sebastianknott\TestUtils\SystemUnderTest\Phake\PhakeBundleFactory;
use Sebastianknott\TestUtils\TestCase\TestToolsCase;

class PhakeBundleFactoryTest extends TestToolsCase
{
    public function testBuild(): void
    {
        $class   = new class {
        };
        $factory = new PhakeBundleFactory();
        $bundle  = $factory->build($class, ['foo' => 'bar']);

        self::assertSame($class, $bundle->getSut());
        self::assertSame($class, $bundle->sut);
        self::assertSame(['foo' => 'bar'], $bundle->getArrayCopy());
        // @phpstan-ignore staticMethod.alreadyNarrowedType
        self::assertInstanceOf(PhakeBundle::class, $bundle);
    }
}
