<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\SystemUnderTest;

use Prophecy\Prophecy\ObjectProphecy;

/**
 * @internal This class is for internal use only. It will change soon and without announcement
 * @phpstan-template T of object
 */
interface MockFactory
{
    /**
     * This method will build a mock object of the given class name. The mock object will be created via the specialized
     * mock framework.
     *
     * @phpstan-template TType of object
     * @phpstan-param class-string<TType> $fqcn
     *
     * @phpstan-return array{'controlObject': object, 'mockObject': TType}
     */
    public function build(string $fqcn): array;
}
