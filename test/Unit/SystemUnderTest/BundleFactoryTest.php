<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\Test\Unit\SystemUnderTest;

use Sebastianknott\TestUtils\SystemUnderTest\Bundle;
use Sebastianknott\TestUtils\SystemUnderTest\BundleFactory;
use Sebastianknott\TestUtils\SystemUnderTest\MockFactory;
use Sebastianknott\TestUtils\SystemUnderTest\SpecializedBundleFactory;
use Sebastianknott\TestUtils\Test\Fixture\SystemUnderTest\ClassWithDependencies;
use Sebastianknott\TestUtils\Test\Fixture\SystemUnderTest\SimpleClass;
use Sebastianknott\TestUtils\TestCase\TestToolsCase;

class BundleFactoryTest extends TestToolsCase
{
    public function testBuildWithoutPrebuildParameters(): void
    {
        $subject = new BundleFactory();

        $className                      = ClassWithDependencies::class;
        $mockedMockFactory              = mock(MockFactory::class);
        $mockedSpecializedBundleFactory = mock(SpecializedBundleFactory::class);
        $mockedSimpleClass              = mock(SimpleClass::class);
        $mockedSimpleClassControl       = mock(SimpleClass::class);
        $expectedBundle                 = mock(Bundle::class);

        $mockedMockFactory->expects()->build(SimpleClass::class)->andReturn(
            ['controlObject' => $mockedSimpleClassControl, 'mockObject' => $mockedSimpleClass],
        );

        $mockedSpecializedBundleFactory->expects()->build(
            anInstanceOf(ClassWithDependencies::class),
            ['simpleClassParameterName' => $mockedSimpleClassControl],
        )->andReturn($expectedBundle);

        $result = $subject->build($className, $mockedMockFactory, $mockedSpecializedBundleFactory);
        self::assertSame($expectedBundle, $result);
    }

    public function testBuildWithPrebuildParameters(): void
    {
        $subject = new BundleFactory();

        $forgedPrebuildParameters = ['simpleClassParameterName' => mock(SimpleClass::class)];

        $className                      = ClassWithDependencies::class;
        $mockedMockFactory              = mock(MockFactory::class);
        $mockedSpecializedBundleFactory = mock(SpecializedBundleFactory::class);
        $mockedSimpleClassControl       = mock(SimpleClass::class);
        $expectedBundle                 = mock(Bundle::class);

        $mockedSpecializedBundleFactory->expects()->build(
            anInstanceOf(ClassWithDependencies::class),
            ['simpleClassParameterName' => $mockedSimpleClassControl],
        )->andReturn($expectedBundle);

        $result = $subject->build(
            $className,
            $mockedMockFactory,
            $mockedSpecializedBundleFactory,
            $forgedPrebuildParameters,
        );
        self::assertSame($expectedBundle, $result);
    }
}
