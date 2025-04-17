<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\SystemUnderTest\Prophecy;

use Override;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophet;
use Sebastianknott\TestUtils\SystemUnderTest\MockFactory;

/**
 * @internal This class is for internal use only. It will change soon and without announcement
 * @phpstan-implements MockFactory<ObjectProphecy>
 */
class ProphecyFactory implements MockFactory
{
    public function __construct(private readonly Prophet $prophet)
    {
    }

    /**
     * This method will build a mock object of the given class name. The mock object will be created via Prophecy.
     *
     * @phpstan-template TType of object
     * @phpstan-param class-string<TType> $fqcn
     *
     * @phpstan-return array{'controlObject': ObjectProphecy, 'mockObject': TType}
     */
    #[Override]
    public function build(string $fqcn): array
    {
        $controlObject = $this->prophet->prophesize($fqcn);
        $mock = $controlObject->reveal();
        return [
            'controlObject' => $controlObject,
            'mockObject' => $mock,
        ];
    }
}
