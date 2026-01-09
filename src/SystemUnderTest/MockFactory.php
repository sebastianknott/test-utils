<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\SystemUnderTest;

/**
 * @internal This class is for internal use only. It will change soon and without announcement
 * @phpstan-template-covariant TType of object the type of mock to be used
 */
interface MockFactory
{
    /**
     * This method will build a mock object of the given class name. The mock object will be created via the specialized
     * mock framework.
     *
     * @phpstan-template T of object The Type of the class to mock
     * @phpstan-param class-string<T> $fqcn
     * @phpstan-return array{'controlObject': object, 'mockObject': T}
     */
    public function build(string $fqcn): array;
}
