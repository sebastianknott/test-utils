<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\SystemUnderTest\Phake;

use Override;
use Phake\IMock;
use Sebastianknott\TestUtils\SystemUnderTest\SpecializedBundleFactory;

/**
 * @phpstan-template TValue of IMock
 * @phpstan-implements SpecializedBundleFactory<TValue>
 */
class PhakeBundleFactory implements SpecializedBundleFactory
{
    /**
     * This method will build a PhakeBundle. The bundle contains mock objects of the given class name and its
     * dependencies. The mock objects will be created via the Prophecy mock framework.
     *
     * @param array<string,object> $parametersInstancesWithName
     *
     * @phpstan-template TSut of object
     * @phpstan-param TSut $systemUnderTestSubject
     * @phpstan-param array<non-empty-string,mixed> $parametersInstancesWithName
     *
     * @phpstan-return PhakeBundle<non-empty-string,TSut>
     */
    #[Override]
    public function build(
        object $systemUnderTestSubject,
        array $parametersInstancesWithName,
    ): PhakeBundle {
        return new PhakeBundle(
            $systemUnderTestSubject,
            $parametersInstancesWithName,
        );
    }
}
