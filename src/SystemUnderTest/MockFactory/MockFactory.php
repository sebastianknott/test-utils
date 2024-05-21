<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\SystemUnderTest\MockFactory;

/**
 * @phpstan-template T of object
 */
interface MockFactory
{
    /**
     * @phpstan-template TType of object
     * @phpstan-param class-string<TType> $fqcn
     *
     * @phpstan-return T&TType
     */
    public function build(string $fqcn): object;
}
