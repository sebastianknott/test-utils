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

        self::assertInstanceOf(IMock::class, $result);
        self::assertInstanceOf(self::class, $result);
    }
}
