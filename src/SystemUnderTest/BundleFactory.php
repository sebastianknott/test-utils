<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\SystemUnderTest;

use ReflectionClass;
use Sebastianknott\TestUtils\SystemUnderTest\MockFactory\MockeryFactory;
use Sebastianknott\TestUtils\SystemUnderTest\MockFactory\MockTypeEnum;
use Sebastianknott\TestUtils\SystemUnderTest\MockFactory\PhakeFactory;

/**
 * This class is responsible for building a system under test with all its dependencies mocked.
 */
class BundleFactory
{
    /**
     * This method will build a system under test with all its dependencies mocked. You can supply prebuilt
     * parameters for the sut and choose which mock framework to use.
     *
     * @param class-string<TSut> $className Fully qualified class name of the system under test
     * @param array<non-empty-string,object> $prebuildParameters Prebuilt parameters for the system under test
     *                                                           it has to be an associative array with the parameter
     *                                                           name of the sut constructor as key and the prebuilt
     *                                                           parameter as value.
     * @param MockTypeEnum $type The type of mock framework to use. Will default to MockTypeEnum::MOCKERY
     *
     * @phpstan-template TSut of object
     * @phpstan-param class-string<TSut> $className
     * @phpstan-param array<non-empty-string,object> $prebuildParameters
     *
     * @phpstan-return Bundle<non-empty-string,TSut,object>
     */
    public function build(
        string $className,
        array $prebuildParameters = [],
        MockTypeEnum $type = MockTypeEnum::MOCKERY,
    ): Bundle {
        $factory = match ($type) {
            MockTypeEnum::MOCKERY => new MockeryFactory(),
            MockTypeEnum::PHAKE => new PhakeFactory(),
        };

        $reflection  = new ReflectionClass($className);
        $constructor = $reflection->getConstructor();

        if ($constructor !== null) {
            $parameters = $constructor->getParameters();
        }

        $parametersInstancesWithName = [];
        $parametersInstances         = [];
        foreach ($parameters ?? [] as $parameter) {
            $parameterClass = $parameter->getType();
            $parameterName  = $parameter->getName();

            if (array_key_exists($parameterName, $prebuildParameters)) {
                $mockedParameter = $prebuildParameters[$parameterName];
            } else {
                $mockedParameter = $factory->build((string) $parameterClass);
            }

            $parametersInstancesWithName[$parameterName] = $mockedParameter;
            $parametersInstances[]                       = $mockedParameter;
        }

        /** @var TSut $systemUnderTestSubject */
        $systemUnderTestSubject = new $className(...$parametersInstances);

        return new Bundle(
            $systemUnderTestSubject,
            $parametersInstancesWithName,
        );
    }
}
