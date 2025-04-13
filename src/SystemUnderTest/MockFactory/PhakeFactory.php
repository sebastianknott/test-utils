<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\SystemUnderTest\MockFactory;

use Override;
use Phake;
use Phake\IMock;

/**
 * @internal This class is for internal use only. It will change soon and without announcement
 * @phpstan-implements MockFactory<IMock>
 */
class PhakeFactory implements MockFactory
{
    /**
     * @phpstan-template TType of object
     * @phpstan-param class-string<TType> $fqcn
     *
     * @phpstan-return IMock&TType
     */
    #[Override]
    public function build(string $fqcn): IMock
    {
        return Phake::mock($fqcn);
    }
}
