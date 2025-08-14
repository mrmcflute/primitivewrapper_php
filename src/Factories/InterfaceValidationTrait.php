<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Factories;


use PrimitiveWrapper\Exceptions\InvalidClassException;

trait InterfaceValidationTrait
{
    /**
     * @param class-string $class
     * @param class-string $expectedInterface
     * @return void
     */
    public static function validateClassImplementsInterface(string|object $class, string $expectedInterface): void
    {
        if (!is_subclass_of($class, $expectedInterface)) {
            self::throwInvalidClassException(is_object($class) ? get_class($class) : $class, $expectedInterface);
        }
    }

    /**
     * @param object $object
     * @param class-string $expectedClass
     * @return void
     */
    public static function validateObjectIsOfClass(object $object, string $expectedClass): void
    {
        if (!(is_a($object, $expectedClass))) {
            self::throwInvalidClassException(get_class($object), $expectedClass);
        }
    }

    /**
     * @param string $class
     * @return void
     */
    public static function validateClassExists(string $class): void
    {
        if (!class_exists($class)) {
            throw new InvalidClassException(sprintf('Invalid Class. Class %s doesn\'t exist or is not loaded', $class));
        }
    }

    private static function throwInvalidClassException(string $class, string $expectedClass): never
    {
        throw new InvalidClassException(sprintf('Invalid Class. Expected %s, got %s', $expectedClass, $class));
    }
}
