<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\Test\Functional\SystemUnderTest;

use Mockery\MockInterface;
use Phake\IMock;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\RunClassInSeparateProcess;
use Prophecy\Prophecy\ObjectProphecy;
use Sebastianknott\TestUtils\SystemUnderTest\BundleFacade;
use Sebastianknott\TestUtils\Test\Fixture\SystemUnderTest\ClassWithDependencies;
use Sebastianknott\TestUtils\Test\Fixture\SystemUnderTest\SimpleClass;
use Sebastianknott\TestUtils\TestCase\TestToolsCase;

#[runClassInSeparateProcess]
class BundleFacadeTest extends TestToolsCase
{
    private BundleFacade $subject;

    protected function setUp(): void
    {
        $this->subject = new BundleFacade();
    }

    /**
     * @return array<string,array<string,string>>
     */
    public static function testBuildSutWithMockeryClassWitDepsDataProvider(): array
    {
        return [
            'Default is Mockery' => [
                'mockClass' => MockInterface::class,
                'managementClass' => MockInterface::class,
                'buildMethod' => 'build',
            ],
            'Mockery' => [
                'mockClass' => MockInterface::class,
                'managementClass' => MockInterface::class,
                'buildMethod' => 'buildMockeryBundle',
            ],
            'Phake' => [
                'mockClass' => IMock::class,
                'managementClass' => IMock::class,
                'buildMethod' => 'buildPhakeBundle',
            ],
            'Prophecy' => [
                'mockClass' => SimpleClass::class,
                'managementClass' => ObjectProphecy::class,
                'buildMethod' => 'buildProphecyBundle',
            ],
        ];
    }

    #[DataProvider('testBuildSutWithMockeryClassWitDepsDataProvider')]
    public function testBuildSutWithMockeryClassWitDeps(
        string $mockClass,
        string $managementClass,
        string $buildMethod,
    ): void {
        $result = $this->subject->$buildMethod(ClassWithDependencies::class);

        assertThat(
            $result,
            hasProperty(
                'sut',
                allOf(
                    anInstanceOf(ClassWithDependencies::class),
                    hasProperty(
                        'simpleClass',
                        anInstanceOf($mockClass),
                    ),
                ),
            ),
        );

        assertThat(
            $result['simpleClassParameterName'],
            anInstanceOf($managementClass),
        );
    }

    public function testBuildProphecyBundleHaveDifferentProphets(): void
    {
        $bundle1 = $this->subject->buildProphecyBundle(ClassWithDependencies::class);
        $bundle2 = $this->subject->buildProphecyBundle(ClassWithDependencies::class);

        self::assertNotSame($bundle1, $bundle2);
    }
}
