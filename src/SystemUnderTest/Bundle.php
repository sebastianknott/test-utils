<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\SystemUnderTest;

use ArrayObject;

/**
 * This class is the base class for all bundles.
 *
 * @phpstan-template TKey of non-empty-string
 * @phpstan-template TSut of object
 * @phpstan-template TValue
 * @phpstan-extends ArrayObject<TKey,TValue>
 */
abstract class Bundle extends ArrayObject
{
    /**
     * @phpstan-param TSut $sut This is the public readable property which holds the system under test.
     * @phpstan-param array<TKey,TValue> $parameters This is the array of parameters which are passed to the
     *                                               constructor of the system under test.
     */
    public function __construct(public readonly object $sut, array $parameters)
    {
        parent::__construct($parameters);
    }

    /**
     * @deprecated Use the public property $sut instead.
     * @api
     * @phpstan-return TSut
     */
    public function getSut(): object
    {
        return $this->sut;
    }
}
