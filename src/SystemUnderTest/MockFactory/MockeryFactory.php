<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\SystemUnderTest\MockFactory;

use Mockery;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;
use Override;

/**
 * @internal This class is for internal use only. It will change soon and without announcement
 * @phpstan-implements MockFactory<LegacyMockInterface&MockInterface>
 */
class MockeryFactory implements MockFactory
{
    /**
     * @phpstan-template TType of object
     * @phpstan-param class-string<TType> $fqcn
     *
     * @phpstan-return LegacyMockInterface&MockInterface&TType
     */
    #[Override]
    public function build(string $fqcn): MockInterface
    {
        return Mockery::mock($fqcn);
    }
}
