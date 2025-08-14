<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Wrappers;

use PrimitiveWrapper\Container;
use PrimitiveWrapper\Exceptions\InvalidClassException;
use PrimitiveWrapper\Factories\GetMethodNameTrait;
use PrimitiveWrapper\Factories\InterfaceValidationTrait;
use PrimitiveWrapper\Factories\TransformerFactory;

class WrapperFactory
{
    use InterfaceValidationTrait;
    use GetMethodNameTrait;

    /**
     * @var array<string, class-string<Wrapper>>
     */
    private array $wrapperMap = [];

    /**
     * @param class-string<Wrapper> $class
     */
    public function bind(string $class): self
    {
        self::validateClassImplementsInterface($class, Wrapper::class);

        $key = $this->getMethodName($class) ?? throw $this->InvalidConfigurationException($class);

        $this->wrapperMap[$key] = $class;

        // create an empty transformer factory and registry to bind our methods to.
        Container::getContainer()
            ->getDefaultWrapperFactoryRegistry()
            ->bind(new TransformerFactory(), $class);

        return $this;
    }

    /**
     * @param string $key
     * @return class-string<Wrapper>
     */
    public function getClass(string $key): string
    {
        return $this->wrapperMap[$key] ?? throw new InvalidClassException();
    }

    public static function __callStatic(string $name, array $arguments): Wrapper
    {
        $wrapperClass = Container::getContainer()
            ->getWrapperFactory()
            ->getClass($name);

        return $wrapperClass::from(...$arguments);
    }
}
