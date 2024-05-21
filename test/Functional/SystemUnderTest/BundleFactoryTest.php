<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\Test\Functional\SystemUnderTest;

use Hamcrest\Matcher;
use Mockery\MockInterface;
use Phake\IMock;
use PHPUnit\Framework\Attributes\DataProvider;
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

        self::assertInstanceOf(SimpleClass::class, $result->getSut());
    }

    /**
     * @return array<string,array<string,string>>
     */
    public static function testBuildSutWithMockeryClassWitDepsDataProvider(): array
    {
        return [
            'Mockery' => [
                'mockClass' => MockInterface::class,
                'type' => MockTypeEnum::MOCKERY,
            ],
            'Phake' => [
                'mockClass' => IMock::class,
                'type' => MockTypeEnum::PHAKE,
            ],
        ];
    }

    #[DataProvider('testBuildSutWithMockeryClassWitDepsDataProvider')]
    public function testBuildSutWithMockeryClassWitDeps(string $mockClass, MockTypeEnum $type): void
    {
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
            $this->isSimpleClassMock($mockClass),
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
            anInstanceOf(SimpleClass::class),
            anInstanceOf($mockClass),
        );
    }
}
