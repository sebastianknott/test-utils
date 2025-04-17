<?php

namespace Sebastianknott\TestUtils\SystemUnderTest\Phake;

use Mockery\MockInterface;
use Override;
use Phake\IMock;
use Sebastianknott\TestUtils\SystemUnderTest\Bundle;
use Sebastianknott\TestUtils\SystemUnderTest\SpecializedBundleFactory;

class PhakeBundleFactory implements SpecializedBundleFactory
{
    /**
     * This method will build a PhakeBundle. The bundle contains mock objects of the given class name and its
     * dependencies. The mock objects will be created via the Prophecy mock framework.
     *
     * @param array<string,object> $parametersInstancesWithName
     *
     * @phpstan-template TSut of object
     *
     * @phpstan-param TSut $systemUnderTestSubject
     * @phpstan-param array<non-empty-string,mixed> $parametersInstancesWithName
     *
     * @phpstan-return Bundle<non-empty-string,TSut,IMock>
     */
    #[Override]
    public function build(
        object $systemUnderTestSubject,
        array $parametersInstancesWithName
    ): PhakeBundle {
        return new PhakeBundle(
            $systemUnderTestSubject,
            $parametersInstancesWithName,
        );
    }
}
