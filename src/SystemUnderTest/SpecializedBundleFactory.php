<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\SystemUnderTest;

interface SpecializedBundleFactory
{
    /**
     * This method will build a specialized bundle of the given class name. The bundle contains mock objects of the
     * given class name and its dependencies. The mock objects will be created via the specialized mock framework.
     *
     * @param array<string,object> $parametersInstancesWithName
     *
     * @phpstan-template TSut of object
     *
     * @phpstan-param TSut $systemUnderTestSubject
     * @phpstan-param array<non-empty-string,mixed> $parametersInstancesWithName
     *
     * @phpstan-return Bundle<non-empty-string,TSut,object>
     */
    public function build(
        object $systemUnderTestSubject,
        array $parametersInstancesWithName,
    ): Bundle;
}
