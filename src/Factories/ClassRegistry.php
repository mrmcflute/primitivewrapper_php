<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Factories;

use PrimitiveWrapper\Container;
use PrimitiveWrapper\Exceptions\InvalidClassException;
use PrimitiveWrapper\Exceptions\InvalidConfigurationException;

/**
 * @template ClassValue
 * @template AttributeClass
 */
class ClassRegistry
{
    use InterfaceValidationTrait;

    /** @var array<string|class-string, ClassValue> */
    private array $elements = [];

    /**
     * @var class-string<AttributeClass>|null
     */
    private ?string $attributeClass = null;

    /** @var callable(AttributeClass $attribute): string|null  */
    private $attributeCallback = null;

    /**
     * @param class-string<ClassValue> $class
     */
    public function __construct(private readonly string $class)
    {
        self::validateClassExists($this->class);
    }

    /**
     * @param class-string $attributeClass
     * @param callable(AttributeClass $attribute): string $attributeCallback
     * @return self
     */
    public function withAttributeForKeyGeneration(string $attributeClass, callable $attributeCallback): self
    {
        self::validateClassExists($attributeClass);

        $this->attributeClass = $attributeClass;
        $this->attributeCallback = $attributeCallback;

        return $this;
    }

    /**
     * @param ClassValue $object
     * @param string|null $key
     * @return self
     */
    public function bind($object, ?string $key = null): self
    {
        self::validateClassImplementsInterface($object, $this->class);

        if (($key === null || $key === '') && $this->attributeClass) {
            $key = $this->getKeyFromAttribute();
        }

        if ($key === null) {
            throw new InvalidConfigurationException('Key could not be ascertained');
        }

        $this->elements[$key] = $object;

        return $this;
    }

    /**
     * @param string $key
     * @return ClassValue
     */
    public function get(string $key)
    {
        $value = $this->elements[$key]
            ?? throw new InvalidClassException('Invalid element ' . $key);

        $args = func_get_args();
        array_shift($args);

        return $value instanceof $this->class
            ? $value
            : new $this->class(...$args);
    }

    private function getKeyFromAttribute(): ?string
    {
        /** @var AttributeClass|null $attribute */
        $attribute = Container::getContainer()
            ->getAttributeCache()
            ->getSingleAttribute($this->class, $this->attributeClass);

        if ($attribute === null) {
            return null;
        }

        return ($this->attributeCallback)($attribute);
    }

    /**
     * @return class-string<ClassValue>
     */
    public function getClass(): string
    {
        return $this->class;
    }
}
