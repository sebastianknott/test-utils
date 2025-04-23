<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\SystemUnderTest\Prophecy;

use Override;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophet;
use Sebastianknott\TestUtils\SystemUnderTest\SpecializedBundleFactory;

/**
 * @phpstan-template TValue of ObjectProphecy<object>
 * @phpstan-implements SpecializedBundleFactory<TValue>
 */
class ProphecyBundleFactory implements SpecializedBundleFactory
{
    public function __construct(private readonly Prophet $prophet)
    {
    }

    /**
     * This method will build a ProphecyBundle. The bundle contains mock objects of the given class name and its
     * dependencies. The mock objects will be created via the Prophecy mock framework.
     *
     * @param array<string,object> $parametersInstancesWithName
     *
     * @phpstan-template TSut of object
     * @phpstan-param TSut $systemUnderTestSubject
     * @phpstan-param array<non-empty-string,mixed> $parametersInstancesWithName
     *
     * @phpstan-return ProphecyBundle<non-empty-string,TSut>
     */
    #[Override]
    public function build(
        object $systemUnderTestSubject,
        array $parametersInstancesWithName,
    ): ProphecyBundle {
        return new ProphecyBundle(
            $systemUnderTestSubject,
            $parametersInstancesWithName,
            $this->prophet,
        );
    }
}
