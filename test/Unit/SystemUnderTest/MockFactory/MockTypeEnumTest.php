<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\Test\Unit\SystemUnderTest\MockFactory;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Sebastianknott\TestUtils\SystemUnderTest\MockFactory\MockTypeEnum;

class MockTypeEnumTest extends TestCase
{
    #[Test]
    public function enumValues(): void
    {
        $this->assertEquals('PHAKE', MockTypeEnum::PHAKE->value);
        $this->assertEquals('MOCKERY', MockTypeEnum::MOCKERY->value);
    }
}
