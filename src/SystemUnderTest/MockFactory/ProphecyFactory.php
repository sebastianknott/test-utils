<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\SystemUnderTest\MockFactory;

use Override;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophet;

/**
 * @internal This class is for internal use only. It will change soon and without announcement
 * @phpstan-implements MockFactory<ObjectProphecy>
 */
class ProphecyFactory implements MockFactory
{
    private Prophet $prophet;

    public function __construct()
    {
        $this->prophet = new Prophet();
    }

    /**
     * @phpstan-template TType of object
     * @phpstan-param class-string<TType> $fqcn
     *
     * @phpstan-return ObjectProphecy<TType>
     */
    #[Override]
    public function build(string $fqcn): ObjectProphecy
    {
        return $this->prophet->prophesize($fqcn);
    }
}
