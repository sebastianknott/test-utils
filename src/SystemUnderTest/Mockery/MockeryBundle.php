<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\SystemUnderTest\Mockery;

use Mockery\MockInterface;
use Sebastianknott\TestUtils\SystemUnderTest\Bundle;

/**
 * {@inheritDoc}
 *
 * @api
 *
 * @phpstan-template TKey of non-empty-string
 * @phpstan-template TSut of object
 * @phpstan-extends Bundle<TKey,TSut,MockInterface|mixed>
 */
class MockeryBundle extends Bundle
{
}
