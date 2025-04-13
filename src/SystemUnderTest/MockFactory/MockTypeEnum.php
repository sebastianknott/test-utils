<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\SystemUnderTest\MockFactory;

/**
 * @internal This class is for internal use only. It will change soon and without announcement
 */
enum MockTypeEnum: string
{
    case PHAKE    = 'PHAKE';
    case MOCKERY  = 'MOCKERY';
    case PROPHECY = 'PROPHECY';
}
