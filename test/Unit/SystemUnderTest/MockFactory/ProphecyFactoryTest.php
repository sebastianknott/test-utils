<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\Test\Unit\SystemUnderTest\MockFactory;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Sebastianknott\TestUtils\SystemUnderTest\MockFactory\ProphecyFactory;

class ProphecyFactoryTest extends TestCase
{
    #[Test]
    public function buildReturnsMock(): void
    {
        $subject = new ProphecyFactory();
        $result  = $subject->build(self::class);

        // @phpstan-ignore staticMethod.alreadyNarrowedType
        self::assertInstanceOf(ObjectProphecy::class, $result);
        // @phpstan-ignore staticMethod.alreadyNarrowedType
        self::assertNotInstanceOf(self::class, $result);
    }
}
