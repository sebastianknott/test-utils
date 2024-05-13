<?php

declare(strict_types=1);

namespace SebastianKnott\TestUtils\SystemUnderTest;

use ArrayObject;
use Mockery\MockInterface;

/**
 * @psalm-suppress MissingTemplateParam
 */
class Bundle extends ArrayObject
{
    /**
     * @param array<string,MockInterface>  $parameters
     */
    public function __construct(private readonly object $subject, array $parameters)
    {
        parent::__construct($parameters);
    }

    public function getSubject(): object
    {
        return $this->subject;
    }
}
