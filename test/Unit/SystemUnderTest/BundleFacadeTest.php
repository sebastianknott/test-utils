<?php

namespace Sebastianknott\TestUtils\Test\Unit\SystemUnderTest;

use DI\Container;
use DI\ContainerBuilder;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use Prophecy\Prophet;
use Sebastianknott\TestUtils\SystemUnderTest\BundleFacade;
use PHPUnit\Framework\TestCase;
use Sebastianknott\TestUtils\SystemUnderTest\BundleFactory;
use Sebastianknott\TestUtils\SystemUnderTest\Mockery\MockeryBundle;
use Sebastianknott\TestUtils\SystemUnderTest\Mockery\MockeryBundleFactory;
use Sebastianknott\TestUtils\SystemUnderTest\Mockery\MockeryFactory;
use Sebastianknott\TestUtils\SystemUnderTest\Phake\PhakeBundle;
use Sebastianknott\TestUtils\SystemUnderTest\Phake\PhakeBundleFactory;
use Sebastianknott\TestUtils\SystemUnderTest\Phake\PhakeFactory;
use Sebastianknott\TestUtils\SystemUnderTest\Prophecy\ProphecyBundle;
use Sebastianknott\TestUtils\SystemUnderTest\Prophecy\ProphecyBundleFactory;
use Sebastianknott\TestUtils\SystemUnderTest\Prophecy\ProphecyFactory;
use Sebastianknott\TestUtils\Test\Fixture\SystemUnderTest\SimpleClass;

class BundleFacadeTest extends TestCase
{
    public static function testBuildDataProvider()
    {
        return [
            'Mockery' => [
                'bundleClass' => MockeryBundle::class,
                'factoryClass' => MockeryFactory::class,
                'bundleFactoryClass' => MockeryBundleFactory::class,
                'buildMethod' => 'buildMockeryBundle',
            ],
            'Phake' => [
                'bundleClass' => PhakeBundle::class,
                'factoryClass' => PhakeFactory::class,
                'bundleFactoryClass' => PhakeBundleFactory::class,
                'buildMethod' => 'buildPhakeBundle',
            ],
        ];
    }

    #[runInSeparateProcess]
    #[preserveGlobalState(false)]
    #[DataProvider('testBuildDataProvider')]
    public function testBuild(
        string $bundleClass,
        string $factoryClass,
        string $bundleFactoryClass,
        string $buildMethod,
    ) {

        // Constructor Setup
        $mockedContainerBuilder = mock('overload:' . ContainerBuilder::class);
        $mockedContainer = mock(Container::class);
        $mockedContainerBuilder->expects()->build()->andReturn($mockedContainer);

        $subject = new BundleFacade();

        $expectedResult = mock($bundleClass);
        $forgedClassName = SimpleClass::class;
        $mockedPrebuildParameters = ['simpleClassParameterName' => mock(SimpleClass::class)];
        $mockedBundleFactory = mock(BundleFactory::class);
        $mockedMockeryFactory = mock($factoryClass);
        $mockedMockeryBundleFactory = mock($bundleFactoryClass);


        $mockedContainer->expects()->get(BundleFactory::class)->andReturn($mockedBundleFactory);
        $mockedContainer->expects()->get($factoryClass)->andReturn($mockedMockeryFactory);
        $mockedContainer->expects()->get($bundleFactoryClass)->andReturn($mockedMockeryBundleFactory);

        $mockedBundleFactory->expects()
            ->build($forgedClassName, $mockedMockeryFactory, $mockedMockeryBundleFactory, $mockedPrebuildParameters)
            ->andReturn($expectedResult);

        $result = $subject->$buildMethod($forgedClassName, $mockedPrebuildParameters);

        self::assertSame($expectedResult, $result);
    }

    #[runInSeparateProcess]
    #[preserveGlobalState(false)]
    public function testBuildProphecyBundle()
    {

        // Constructor Setup
        $mockedContainerBuilder = mock('overload:' . ContainerBuilder::class);
        $mockedContainer = mock(Container::class);
        $mockedContainerBuilder->expects()->build()->andReturn($mockedContainer);

        $subject = new BundleFacade();

        $expectedResult = mock(ProphecyBundle::class);
        $forgedClassName = SimpleClass::class;
        $mockedPrebuildParameters = ['simpleClassParameterName' => mock(SimpleClass::class)];
        $mockedProphet = mock(Prophet::class);
        $mockedBundleFactory = mock(BundleFactory::class);
        $mockedMockeryFactory = mock(ProphecyFactory::class);
        $mockedMockeryBundleFactory = mock(ProphecyBundleFactory::class);


        $mockedContainer->expects()->get(BundleFactory::class)->andReturn($mockedBundleFactory);
        $mockedContainer->expects()->make(Prophet::class)->andReturn($mockedProphet);
        $mockedContainer->expects()->make(ProphecyFactory::class, [$mockedProphet])->andReturn($mockedMockeryFactory);
        $mockedContainer->expects()->make(ProphecyBundleFactory::class, [$mockedProphet])->andReturn($mockedMockeryBundleFactory);

        $mockedBundleFactory->expects()
            ->build($forgedClassName, $mockedMockeryFactory, $mockedMockeryBundleFactory, $mockedPrebuildParameters)
            ->andReturn($expectedResult);

        $result = $subject->buildProphecyBundle($forgedClassName, $mockedPrebuildParameters);

        self::assertSame($expectedResult, $result);
    }
}
