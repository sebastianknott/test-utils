<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\SystemUnderTest;

use ArrayObject;

/**
 * @phpstan-template TKey of non-empty-string
 * @phpstan-template TSut of object
 * @phpstan-template TValue
 * @phpstan-extends ArrayObject<TKey,TValue>
 */
class Bundle extends ArrayObject
{
    /**
     * @phpstan-param TSut               $sut
     * @phpstan-param array<TKey,TValue> $parameters
     */
    public function __construct(private readonly object $sut, array $parameters)
    {
        parent::__construct($parameters);
    }

    /**
     * @phpstan-return TSut
     */
    public function getSut(): object
    {
        return $this->sut;
    }
}
