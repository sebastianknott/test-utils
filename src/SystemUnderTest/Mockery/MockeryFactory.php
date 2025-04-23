<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\SystemUnderTest\Mockery;

use Mockery;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;
use Override;
use Sebastianknott\TestUtils\SystemUnderTest\MockFactory;

/**
 * @internal This class is for internal use only. It will change soon and without announcement
 * @phpstan-implements MockFactory<LegacyMockInterface&MockInterface>
 */
class MockeryFactory implements MockFactory
{
    /**
     * @phpstan-template T of object
     * @phpstan-param class-string<T> $fqcn
     *
     * @phpstan-return array{
     *                  'controlObject':LegacyMockInterface&MockInterface&T,
     *                  'mockObject':LegacyMockInterface&MockInterface&T
     *                 }
     */
    #[Override]
    public function build(string $fqcn): array
    {
        $mock = Mockery::mock($fqcn);

        return [
            'controlObject' => $mock,
            'mockObject' => $mock,
        ];
    }
}
