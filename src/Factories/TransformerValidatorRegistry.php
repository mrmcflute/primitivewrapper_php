<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Factories;

use PrimitiveWrapper\Attributes\WithArgument;
use PrimitiveWrapper\Container;
use PrimitiveWrapper\Transformer\Transformer;
use PrimitiveWrapper\Validator\ArgumentCollection;
use PrimitiveWrapper\Validator\DefaultValidator;
use ReflectionException;

class TransformerValidatorRegistry
{
    use InterfaceValidationTrait;

    /**
     * @var array<class-string<Transformer>, ArgumentCollection>
     */
    private array $transformerMap = [];
    private static TransformerValidatorRegistry $registry;

    private const string DEFAULT_VALIDATOR_CLASS = DefaultValidator::class;

    public static function getRegistry(): self
    {
        return self::$registry ??= new self();
    }

    /**
     * @param class-string<Transformer> $class
     * @return TransformerValidatorRegistry
     * @throws ReflectionException
     */
    public function bind(string $class): TransformerValidatorRegistry
    {
        self::validateClassImplementsInterface($class, Transformer::class);

        $arguments = Container::getContainer()
            ->getAttributeCache()
            ->getAttributesForClass($class, WithArgument::class);

        $this->transformerMap[$class] = new ArgumentCollection($arguments);

        return $this;
    }

    /**
     * @param string $key
     * @return ArgumentCollection
     */
    public function get(string $key): ArgumentCollection
    {
        self::validateClassImplementsInterface($key, Transformer::class);

        return $this->transformerMap[$key] ?? new ArgumentCollection();
    }
}