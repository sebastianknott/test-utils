<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\SystemUnderTest;

use DI\Container;
use DI\ContainerBuilder;
use Mockery;
use Phake\IMock;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophet;
use Sebastianknott\TestUtils\SystemUnderTest\Mockery\MockeryBundle;
use Sebastianknott\TestUtils\SystemUnderTest\Mockery\MockeryBundleFactory;
use Sebastianknott\TestUtils\SystemUnderTest\Mockery\MockeryFactory;
use Sebastianknott\TestUtils\SystemUnderTest\Phake\PhakeBundle;
use Sebastianknott\TestUtils\SystemUnderTest\Phake\PhakeBundleFactory;
use Sebastianknott\TestUtils\SystemUnderTest\Phake\PhakeFactory;
use Sebastianknott\TestUtils\SystemUnderTest\Prophecy\ProphecyBundle;
use Sebastianknott\TestUtils\SystemUnderTest\Prophecy\ProphecyBundleFactory;
use Sebastianknott\TestUtils\SystemUnderTest\Prophecy\ProphecyFactory;

/**
 * This class should be used to interact with the sut bundle system.
 *
 * @api
 */
class BundleFacade
{
    private Container $container;

    public function __construct()
    {
        $containerBuilder = new ContainerBuilder();

        $this->container = $containerBuilder->build();
    }

    /**
     * This method will build a system under test with all its dependencies mocked. You can supply prebuilt
     * parameters for the sut. This method will create Mocks via the Mockery framework.
     *
     * @param class-string<TSut> $className Fully qualified class name of the system under test
     * @param array<non-empty-string,object> $prebuildParameters Prebuilt parameters for the system under test
     *                                                           it has to be an associative array with the parameter
     *                                                           name of the sut constructor as key and the prebuilt
     *                                                           parameter as value.
     *
     * @phpstan-template TSut of object
     * @phpstan-param class-string<TSut> $className
     * @phpstan-param array<non-empty-string,object> $prebuildParameters
     *
     * @phpstan-return MockeryBundle<non-empty-string,TSut>
     * @api
     */
    public function build(
        string $className,
        array $prebuildParameters = [],
    ): MockeryBundle {
        return $this->buildMockeryBundle($className, $prebuildParameters);
    }

    /**
     * This method will build a system under test with all its dependencies mocked. You can supply prebuilt
     * parameters for the sut. This method will creat Mocks via the Mockery framework.
     *
     * @param class-string<TSut> $className Fully qualified class name of the system under test
     * @param array<non-empty-string,object> $prebuildParameters Prebuilt parameters for the system under test
     *                                                           it has to be an associative array with the parameter
     *                                                           name of the sut constructor as key and the prebuilt
     *                                                           parameter as value.
     *
     * @phpstan-template TSut of object
     * @phpstan-param class-string<TSut> $className
     * @phpstan-param array<non-empty-string,object> $prebuildParameters
     *
     * @phpstan-return MockeryBundle<non-empty-string,TSut>
     *
     * @api
     */
    public function buildMockeryBundle(
        string $className,
        array $prebuildParameters = [],
    ): MockeryBundle {
        $factory = $this->container->get(BundleFactory::class);
        /** @var MockFactory<Mockery> $mockFactory */
        $mockFactory   = $this->container->get(MockeryFactory::class);
        $bundleFactory = $this->container->get(MockeryBundleFactory::class);
        return $factory->build($className, $mockFactory, $bundleFactory, $prebuildParameters);
    }

    /**
     * This method will build a system under test with all its dependencies mocked. You can supply prebuilt
     * parameters for the sut. This method will creat Mocks via the Phaker framework.
     *
     * @param class-string<TSut> $className Fully qualified class name of the system under test
     * @param array<non-empty-string,object> $prebuildParameters Prebuilt parameters for the system under test
     *                                                           it has to be an associative array with the parameter
     *                                                           name of the sut constructor as key and the prebuilt
     *                                                           parameter as value.
     *
     * @phpstan-template TSut of object
     * @phpstan-param class-string<TSut> $className
     * @phpstan-param array<non-empty-string,object> $prebuildParameters
     *
     * @phpstan-return PhakeBundle<non-empty-string,TSut>
     * @api
     */
    public function buildPhakeBundle(
        string $className,
        array $prebuildParameters = [],
    ): PhakeBundle {
        $factory = $this->container->get(BundleFactory::class);
        /** @var MockFactory<IMock> $mockFactory */
        $mockFactory   = $this->container->get(PhakeFactory::class);
        $bundleFactory = $this->container->get(PhakeBundleFactory::class);
        return $factory->build($className, $mockFactory, $bundleFactory, $prebuildParameters);
    }

    /**
     * This method will build a system under test with all its dependencies mocked. You can supply prebuilt
     * parameters for the sut. This method will creat Mocks via the Prophecy framework.
     *
     * @param class-string<TSut> $className Fully qualified class name of the system under test
     * @param array<non-empty-string,object> $prebuildParameters Prebuilt parameters for the system under test
     *                                                           it has to be an associative array with the parameter
     *                                                           name of the sut constructor as key and the prebuilt
     *                                                           parameter as value.
     *
     * @phpstan-template TSut of object
     * @phpstan-param class-string<TSut> $className
     * @phpstan-param array<non-empty-string,object> $prebuildParameters
     *
     * @phpstan-return ProphecyBundle<non-empty-string,TSut>
     * @api
     */
    public function buildProphecyBundle(
        string $className,
        array $prebuildParameters = [],
    ): ProphecyBundle {
        $factory = $this->container->get(BundleFactory::class);
        $prophet = $this->container->make(Prophet::class);
        /** @var MockFactory<ObjectProphecy<object>> $mockFactory */
        $mockFactory   = $this->container->make(ProphecyFactory::class, [$prophet]);
        $bundleFactory = $this->container->make(ProphecyBundleFactory::class, [$prophet]);
        return $factory->build($className, $mockFactory, $bundleFactory, $prebuildParameters);
    }
}
