<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\SystemUnderTest\MockFactory;

use Mockery;
use Mockery\MockInterface;

/**
 * @phpstan-template T of MockInterface
 * @phpstan-implements MockFactory<T>
 */
class MockeryFactory implements MockFactory
{
    /**
     * @phpstan-template TType of object
     * @phpstan-param class-string<TType> $fqcn
     *
     * @phpstan-return T&TType
     */
    public function build(string $fqcn): MockInterface
    {
        return Mockery::mock($fqcn);
    }
}
