<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\SystemUnderTest\MockFactory;

use Prophecy\Prophecy\ObjectProphecy;

/**
 * @internal This class is for internal use only. It will change soon and without announcement
 * @phpstan-template T of object
 */
interface MockFactory
{
    /**
     * @phpstan-template TType of object
     * @phpstan-param class-string<TType> $fqcn
     *
     * @phpstan-return ObjectProphecy<TType>|(T&TType)
     */
    public function build(string $fqcn): object;
}
