<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\Test\Unit\SystemUnderTest\MockFactory;

use Phake\IMock;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Sebastianknott\TestUtils\SystemUnderTest\MockFactory\PhakeFactory;

class PhakeFactoryTest extends TestCase
{
    #[Test]
    public function buildReturnsMock(): void
    {
        $subject = new PhakeFactory();
        $result  = $subject->build(self::class);

        // @phpstan-ignore staticMethod.alreadyNarrowedType
        self::assertInstanceOf(IMock::class, $result);
        // @phpstan-ignore staticMethod.alreadyNarrowedType
        self::assertInstanceOf(self::class, $result);
    }
}
