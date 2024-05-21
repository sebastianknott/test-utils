<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\SystemUnderTest\MockFactory;

enum MockTypeEnum: string
{
    case PHAKE   = 'PHAKE';
    case MOCKERY = 'MOCKERY';
}
