<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\Test\Functional\SystemUnderTest;

use Hamcrest\Matcher;
use Mockery\MockInterface;
use Phake\IMock;
use PHPUnit\Framework\Attributes\DataProvider;
use Prophecy\Prophecy\ObjectProphecy;
use Sebastianknott\TestUtils\SystemUnderTest\BundleFactory;
use Sebastianknott\TestUtils\SystemUnderTest\MockFactory\MockTypeEnum;
use Sebastianknott\TestUtils\Test\Fixture\SystemUnderTest\ClassWithDependencies;
use Sebastianknott\TestUtils\Test\Fixture\SystemUnderTest\SimpleClass;
use Sebastianknott\TestUtils\TestCase\TestToolsCase;

class BundleFactoryTest extends TestToolsCase
{
    private BundleFactory $subject;

    public function setUp(): void
    {
        $this->subject = new BundleFactory();
    }

    public function testBuildSutWithMockeryShouldBuildAnInstanceOfSimpleClass(): void
    {
        $result = $this->subject->build(SimpleClass::class);

        // @phpstan-ignore staticMethod.alreadyNarrowedType
        self::assertInstanceOf(SimpleClass::class, $result->getSut());
    }

    /**
     * @return array<string,array<string,MockTypeEnum|string>>
     */
    public static function testBuildSutWithMockeryClassWitDepsDataProvider(): array
    {
        return [
            'Mockery' => [
                'mockClass' => MockInterface::class,
                'managementClass' => MockInterface::class,
                'type' => MockTypeEnum::MOCKERY,
            ],
            'Phake' => [
                'mockClass' => IMock::class,
                'managementClass' => IMock::class,
                'type' => MockTypeEnum::PHAKE,
            ],
            'Prophecy' => [
                'mockClass' => SimpleClass::class,
                'managementClass' => ObjectProphecy::class,
                'type' => MockTypeEnum::PROPHECY,
            ],
        ];
    }

    #[DataProvider('testBuildSutWithMockeryClassWitDepsDataProvider')]
    public function testBuildSutWithMockeryClassWitDeps(
        string $mockClass,
        string $managementClass,
        MockTypeEnum $type,
    ): void {
        $result = $this->subject->build(ClassWithDependencies::class, type: $type);

        assertThat(
            $result,
            hasProperty(
                'sut',
                allOf(
                    anInstanceOf(ClassWithDependencies::class),
                    hasProperty(
                        'simpleClass',
                        $this->isSimpleClassMock($mockClass),
                    ),
                ),
            ),
        );

        assertThat(
            $result['simpleClassParameterName'],
            $this->isSimpleClassMock(mockClass: $managementClass),
        );
    }

    public function testPrebuildParametersAreUsedIfGiven(): void
    {
        $forgedSimpleClass = new SimpleClass();
        $result            = $this->subject->build(
            ClassWithDependencies::class,
            ['simpleClassParameterName' => $forgedSimpleClass],
        );

        self::assertSame($forgedSimpleClass, $result['simpleClassParameterName']);
    }

    /**
     * Returns Matcher to check if something is a SimpleClass and of type mockClass.
     */
    private function isSimpleClassMock(string $mockClass): Matcher
    {
        return allOf(
            anInstanceOf($mockClass),
        );
    }
}
