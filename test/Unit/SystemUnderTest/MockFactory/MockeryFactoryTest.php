<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\Test\Unit\SystemUnderTest\MockFactory;

use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Sebastianknott\TestUtils\SystemUnderTest\MockFactory\MockeryFactory;

class MockeryFactoryTest extends TestCase
{
    #[Test]
    public function buildReturnsMock(): void
    {
        $subject = new MockeryFactory();
        $result  = $subject->build(self::class);

        self::assertInstanceOf(MockInterface::class, $result);
    }
}
