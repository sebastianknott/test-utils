<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\SystemUnderTest\MockFactory;

use Phake;
use Phake\IMock;

/**
 * @phpstan-template T of IMock
 * @phpstan-implements MockFactory<T>
 */
class PhakeFactory implements MockFactory
{
    /**
     * @phpstan-template TType of object
     * @phpstan-param class-string<TType> $fqcn
     *
     * @phpstan-return T&TType
     */
    public function build(string $fqcn): IMock
    {
        return Phake::mock($fqcn);
    }
}
