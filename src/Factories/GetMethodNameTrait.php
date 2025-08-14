<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Factories;


use PrimitiveWrapper\Attributes\AsMethod;
use PrimitiveWrapper\Container;
use PrimitiveWrapper\Exceptions\InvalidConfigurationException;

trait GetMethodNameTrait
{
    /**
     * @param class-string $class
     * @param string|null $key
     * @return string|null
     */
    public function getMethodName(string $class, ?string $key = null): ?string
    {
        $methodAttribute = Container::getContainer()
            ->getAttributeCache()
            ->getSingleAttribute($class, AsMethod::class);

        return $key ?? $methodAttribute->methodName ?? null;
    }

    /**
     * @param class-string $class
     *
     */
    public function InvalidConfigurationException(string $class): InvalidConfigurationException
    {
        return new InvalidConfigurationException(sprintf('Could not ascertain method name for validator %s', $class));
    }
}