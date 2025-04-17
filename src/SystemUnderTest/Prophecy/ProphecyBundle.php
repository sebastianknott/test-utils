<?php

namespace Sebastianknott\TestUtils\SystemUnderTest\Prophecy;

use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophet;
use Sebastianknott\TestUtils\SystemUnderTest\Bundle;

/**
 * @api
 *
 * @phpstan-template TKey of non-empty-string
 * @phpstan-template TSut of object
 * @phpstan-template TValue of ObjectProphecy
 * @phpstan-extends Bundle<TKey,TSut,TValue>
 */
class ProphecyBundle extends Bundle
{
    /**
     * @phpstan-param TSut $sut
     * @phpstan-param array<TKey,TValue> $parameters
     */
    public function __construct(
        object                  $sut,
        array                   $parameters,
        public readonly Prophet $prophet
    ) {
        parent::__construct($sut, $parameters);
    }
}
