<?php

declare(strict_types=1);

namespace Sebastianknott\TestUtils\TestCase;

use Composer\Autoload\ClassLoader;
use Faker\Factory;
use Faker\Generator;
use Mockery;
use Override;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Sebastianknott\TestUtils\SystemUnderTest\BundleFactory;

class TestToolsCase extends TestCase
{
    use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    /**
     * A ready-made faker instance for your unit tests.
     */
    public static Generator $faker;
    /**
     * An instance of my subject factory for easy sut creation and mocking.
     */
    public static BundleFactory $factory;

    /**
     * This method will instantiate the factory and faker. Father more the global functions of hamcrest and mockery
     * will be loaded.
     */
    #[Override]
    public static function setUpBeforeClass(): void
    {
        self::$factory = new BundleFactory();

        self::$faker = Factory::create('de_DE');
        self::$faker->seed(9876543255);

        $reflection = new ReflectionClass(ClassLoader::class);
        $vendorDir  = dirname($reflection->getFileName(), 2);

        require_once $vendorDir . '/hamcrest/hamcrest-php/hamcrest/Hamcrest.php';
        require_once $vendorDir . '/sebastianknott/hamcrest-object-accessor/src/functions.php';
        require_once $vendorDir . '/mockery/mockery/library/helpers.php';
    }

    /**
     * Necessary tearDown functionality for Mockery.
     */
    #[Override]
    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }
}
