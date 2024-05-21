<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\Test\Fixture\SystemUnderTest;

class ClassWithDependencies
{
    private SimpleClass $simpleClass;

    /**
     * ClassWithDependencies constructor.
     *
     */
    public function __construct(SimpleClass $simpleClassParameterName)
    {
        $this->simpleClass = $simpleClassParameterName;
    }

    public function getSimpleClass(): SimpleClass
    {
        return $this->simpleClass;
    }
}
