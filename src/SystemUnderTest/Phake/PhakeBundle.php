<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\SystemUnderTest\Phake;

use Phake\IMock;
use Sebastianknott\TestUtils\SystemUnderTest\Bundle;

/**
 * {@inheritDoc}
 *
 * @api
 * @phpstan-template TKey of non-empty-string
 * @phpstan-template TSut of object
 * @phpstan-extends Bundle<TKey,TSut,IMock|mixed>
 */
class PhakeBundle extends Bundle
{
}
