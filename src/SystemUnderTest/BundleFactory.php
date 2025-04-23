<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\SystemUnderTest;

use ReflectionClass;

/**
 * This class is responsible for building a system under test with all its dependencies mocked.
 */
class BundleFactory
{
    /**
     * This method will build a system under test with all its dependencies mocked. You can supply prebuilt
     * parameters for the sut and choose which mock framework to use.
     *
     * @phpstan-template TSut of object The type of the System Under Test
     *
     * @param string $className Fully qualified class name of the system under test
     * @param array<non-empty-string,object> $prebuildParameters Prebuilt parameters for the system under test
     *                                                           it has to be an associative array with the parameter
     *                                                           name of the sut constructor as key and the prebuilt
     *                                                           parameter as value.
     *
     * @phpstan-param class-string<TSut> $className
     * @phpstan-param MockFactory<object> $factory
     * @phpstan-param SpecializedBundleFactory<object> $specializedBundleFactory
     *
     * @phpstan-return Bundle<non-empty-string,TSut,object>
     *
     * @api
     */
    public function build(
        string $className,
        MockFactory $factory,
        SpecializedBundleFactory $specializedBundleFactory,
        array $prebuildParameters = [],
    ): Bundle {
        $reflection  = new ReflectionClass($className);
        $constructor = $reflection->getConstructor();

        if ($constructor !== null) {
            $parameters = $constructor->getParameters();
        }

        $controlObjects      = [];
        $parametersInstances = [];
        foreach ($parameters ?? [] as $parameter) {
            /** @var class-string<object> $parameterClass */
            $parameterClass = $parameter->getType();
            $parameterName  = $parameter->getName();

            if (array_key_exists($parameterName, $prebuildParameters)) {
                $controlObject = $prebuildParameters[$parameterName];
                $mockObject    = $prebuildParameters[$parameterName];
            } else {
                list(
                    'controlObject' => $controlObject,
                    'mockObject' => $mockObject
                    ) = $factory->build((string) $parameterClass);
            }

            $controlObjects[$parameterName] = $controlObject;
            $parametersInstances[]          = $mockObject;
        }

        $systemUnderTestSubject = new $className(...$parametersInstances);

        return $specializedBundleFactory->build($systemUnderTestSubject, $controlObjects);
    }
}
