<?php

declare(strict_types=1);

namespace SebastianKnott\TestUtils\SystemUnderTest;

use Closure;
use Mockery;
use Phake;
use ReflectionClass;

class BundleFactory
{
    /**
     * Builds a subject with mocked constructor dependencies with Mockery.
     *
     *
     */
    public function buildSutWithMockery(string $className): object
    {
        $buildFunction = static function ($className): object {
            return Mockery::mock($className);
        };

        return $this->generateSubjectByBuildFunction($className, $buildFunction);
    }

    /**
     * Builds a subject with mocked constructor dependencies with Mockery.
     *
     *
     */
    public function buildSutWithPhake(string $className): object
    {
        $buildFunction = static function ($className): object {
            return Phake::mock($className);
        };

        return $this->generateSubjectByBuildFunction($className, $buildFunction);
    }

    /**
     * Generates instance of class. Uses buildFunction to generate constructor parameters.
     *
     *
     */
    private function generateSubjectByBuildFunction(string $className, Closure $buildFunction): Bundle
    {
        $reflection  = new ReflectionClass($className);
        $constructor = $reflection->getConstructor();

        if ($constructor !== null) {
            $parameters = $constructor->getParameters();
        }

        $parametersInstancesWithName = [];
        $parametersInstances         = [];
        foreach ($parameters ?? [] as $parameter) {
            $parameterClass  = $parameter->getClass();
            $parameterName   = $parameter->getName();
            $mockedParameter = $buildFunction($parameterClass->getName());

            $parametersInstancesWithName[$parameterName] = $mockedParameter;
            $parametersInstances[]                       = $mockedParameter;
        }

        $systemUnderTestSubject = new $className(...$parametersInstances);

        return new Bundle(
            $systemUnderTestSubject,
            $parametersInstancesWithName,
        );
    }
}
