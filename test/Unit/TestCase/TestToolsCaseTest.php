<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\Test\Unit\TestCase;

use Faker\Generator;
use PHPUnit\Framework\TestCase;
use Safe\DateTime;
use Sebastianknott\TestUtils\SystemUnderTest\BundleFactory;
use Sebastianknott\TestUtils\Test\Fixture\SystemUnderTest\ClassWithDependencies;
use Sebastianknott\TestUtils\Test\Fixture\SystemUnderTest\SimpleClass;
use Sebastianknott\TestUtils\TestCase\TestToolsCase;

class TestToolsCaseTest extends TestCase
{
    private TestToolsCase $subject;

    protected function setUp(): void
    {
        $this->subject = new TestToolsCase('argh');
        $this->subject::setUpBeforeClass();
    }

    public function testToolsAvailable(): void
    {
        // @phpstan-ignore staticMethod.alreadyNarrowedType
        self::assertInstanceOf(Generator::class, $this->subject::$faker);
        self::assertSame('velit', $this->subject::$faker->word());
        // @phpstan-ignore staticMethod.alreadyNarrowedType
        self::assertInstanceOf(BundleFactory::class, $this->subject::$factory);

        assertThat(
            new ClassWithDependencies(new SimpleClass()),
            hasProperty('simpleClass', anInstanceOf(SimpleClass::class)),
        );
        mock(DateTime::class);
    }
}
