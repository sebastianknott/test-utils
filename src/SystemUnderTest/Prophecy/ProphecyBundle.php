<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\SystemUnderTest\Prophecy;

use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophet;
use Sebastianknott\TestUtils\SystemUnderTest\Bundle;

/**
 * {@inheritDoc}
 *
 * @api
 * @phpstan-template TKey of non-empty-string
 * @phpstan-template TSut of object
 * @phpstan-extends Bundle<TKey,TSut,ObjectProphecy<object>|mixed>
 */
class ProphecyBundle extends Bundle
{
    /**
     * @phpstan-param TSut $sut
     * @phpstan-param array<TKey,ObjectProphecy<object>> $parameters
     */
    public function __construct(
        object $sut,
        array $parameters,
        public readonly Prophet $prophet,
    ) {
        parent::__construct($sut, $parameters);
    }
}
