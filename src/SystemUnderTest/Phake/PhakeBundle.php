<?php

namespace Sebastianknott\TestUtils\SystemUnderTest\Phake;

use Phake\IMock;
use Sebastianknott\TestUtils\SystemUnderTest\Bundle;

/**
 * @api
 *
 * @phpstan-template TKey of non-empty-string
 * @phpstan-template TSut of object
 * @phpstan-extends Bundle<TKey,TSut,IMock>
 */
class PhakeBundle extends Bundle
{
}
