# test-utils
Some classes i like to use for testing purposes

## System Under Test (SUT) Factory

I don't like to do tedious work, so I created a factory that creates the
System Under Test (SUT) for me. The factory creates a new instance of the
SUT and mocks its constructor dependencies as good as it can.

It returns a `Bundle` object that contains the SUT and the mocks.

```php

class SomeClass
{
    public function __construct(Dependency $myDependency)
    {
        // ...
    }
}

class Dependency{
    public function someMethod()
    {
        // ...
    }
}

$factory = new BundleFactory();
$bundel = $factory->build(SomeClass::class);

// Get the SUT
$sut = $bundle->sut;
// Access the mocked dependencies
$bundle['myDependency']->expects()->someMethod()->once();
```
### Type of Mocks
It supports multiple types of mocking libraries ([Mockery](https://github.com/mockery/mockery),
[Phake](https://github.com/phake/phake), [Prophecy](https://github.com/phpspec/prophecy)) and can be configured to use one of them by passing the respective
`MockTypeEnum` to `BundleFactory::build`.

```php
[...]
$bundel = $factory->build(SomeClass::class, type: MockTypeEnum::MOCKERY);
[...]
```

### Prebuild Parameters

If the SUT has dependencies that are not mockable, you can pass them as a
prebuild parameter to the factory. The prebuild parameter is an associative
array where the key is the name of the parameter in the suts constructor and
the value is the instance.

```php
[...]
$prebuildParameters = [
    'myDependency' => new Dependency()
];
$bundel = $factory->build(
    SomeClass::class,
    prebuildParameters: $prebuildParameters
);
[...]
```

## TestToolsCase

I found myself writing the same boilerplate code over and over again. So I
condensed it into a base class that I can extend from.

It does the following:
- Make a sut factory available `self::$bundleFactory`
- Make faker available `self::$faker`
- Require hamcrest and Mockery

So instead of writing this:

```php
class SomeTest extends \PHPUnit\Framework\TestCase
{
    private $bundleFactory;
    private $faker;
    private $mockedDependency;

    public function setUp()
    {
        $this->bundleFactory = new BundleFactory();
        $this->faker = \Faker\Factory::create();
        $this->faker->seed(9876543255);
        $this->mockedDependency = \Mockery::mock(Dependency::class);
        $this->subject = new SomeClass($this->mockedDependency);
    }

    public function testSomething()
{
        $this->mockedDependency->expects()
            ->someMethod(Matchers::stringValue())
            ->andReturn($this->faker->word());
        $sut->run();
    }

    public function tearDown()
    {
        \Mockery::close();
    }
}
```

I write that:

```php
class SomeTest extends TestToolsCase
{
    public function testSomething()
    {
        $bundle = self::$bundleFactory->build(SomeClass::class);
        $bundle['myDependency']->expects()
            ->someMethod(stringValue())->andReturn(self::$faker->word());

        $bundle->sut->run();
    }
}
```


