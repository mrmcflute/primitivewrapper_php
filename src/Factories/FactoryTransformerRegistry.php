<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Factories;

use PrimitiveWrapper\Container;
use PrimitiveWrapper\Exceptions\Transformer\InvalidMethodException;
use PrimitiveWrapper\Transformer\Transformer;

class FactoryTransformerRegistry implements RegistryInterface
{
    use InterfaceValidationTrait;
    use GetMethodNameTrait;
    /**
     * @var array<string, class-string<Transformer>
     */
    private array $transformerMap;

    public function get(string $key): Transformer
    {
        $classString = $this->transformerMap[$key]
            ?? throw new InvalidMethodException('Invalid Method Name: ' . $key);

        return new $classString();
    }

    /**
     * @param class-string<Transformer> $object
     * @param string|null $key
     * @return FactoryTransformerRegistry
     */
    public function bind($object, ?string $key = null): self
    {
        self::validateClassImplementsInterface($object, Transformer::class);

        $methodName = $this->getMethodName($object, $key) ?? throw $this->InvalidConfigurationException($object);

        $this->transformerMap[$methodName] = $object;

        Container::getContainer()
            ->getTransformerValidatorRegistry()
            ->bind($object);

        return $this;
    }
}
