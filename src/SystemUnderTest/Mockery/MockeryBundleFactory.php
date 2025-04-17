<?php

namespace Sebastianknott\TestUtils\SystemUnderTest\Mockery;

use Mockery\MockInterface;
use Override;
use Sebastianknott\TestUtils\SystemUnderTest\Bundle;
use Sebastianknott\TestUtils\SystemUnderTest\SpecializedBundleFactory;

class MockeryBundleFactory implements SpecializedBundleFactory
{

    /**
     * This method will build a MockeryBundle. The bundle contains mock objects of the given class name and its
     * dependencies. The mock objects will be created via the Prophecy mock framework.
     *
     * @param array<string,object> $parametersInstancesWithName
     *
     * @phpstan-template TSut of object
     *
     * @phpstan-param TSut $systemUnderTestSubject
     * @phpstan-param array<non-empty-string,mixed> $parametersInstancesWithName
     *
     * @phpstan-return Bundle<non-empty-string,TSut,MockInterface>
     */
    #[Override]
    public function build(
        object $systemUnderTestSubject,
        array  $parametersInstancesWithName
    ): MockeryBundle {
        return new MockeryBundle(
            $systemUnderTestSubject,
            $parametersInstancesWithName,
        );
    }
}
