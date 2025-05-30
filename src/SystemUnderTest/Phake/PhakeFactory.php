<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\SystemUnderTest\Phake;

use Override;
use Phake;
use Phake\IMock;
use Sebastianknott\TestUtils\SystemUnderTest\MockFactory;

/**
 * @internal This class is for internal use only. It will change soon and without announcement
 * @phpstan-implements MockFactory<IMock>
 */
class PhakeFactory implements MockFactory
{
    /**
     * @phpstan-template T of object
     * @phpstan-param class-string<T> $fqcn
     *
     * @phpstan-return array{'controlObject':IMock&T, 'mockObject': IMock&T}
     */
    #[Override]
    public function build(string $fqcn): array
    {
        $mock = Phake::mock($fqcn);

        return [
            'controlObject' => $mock,
            'mockObject' => $mock,
        ];
    }
}
