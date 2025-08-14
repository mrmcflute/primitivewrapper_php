<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Factories;

use Attribute;
use ReflectionAttribute;
use ReflectionClass;

/**
 * @template AttributeClass
 */
class AttributeCache
{
    /**
     * @var array<class-string, array<class-string<Attribute>, Attribute>>
     */
    private array $attributeMap = [];

    /**
     * @param class-string $class
     * @param class-string<AttributeClass> $attributeClass
     * @return AttributeClass[]
     */
    public function getAttributesForClass(string $class, string $attributeClass): array
    {
        return $this->attributeMap[$class][$attributeClass] ??= $this->buildAttributeMap($class, $attributeClass);
    }

    /**
     * @param class-string $class
     * @param class-string<AttributeClass> $attributeClass
     * @return AttributeClass|null
     */
    public function getSingleAttribute(string $class, string $attributeClass)
    {
        return $this->getAttributesForClass($class, $attributeClass)[0] ?? null;
    }

    /**
     * @param class-string $class
     * @param class-string<AttributeClass> $attributeClass
     * @return AttributeClass[]
     */
    private function buildAttributeMap(string $class, string $attributeClass): array
    {
        $reflection = new ReflectionClass($class);

        /**
         * @var ReflectionAttribute $attribute
         */
        foreach ($reflection->getAttributes() as $attribute) {
            $this->attributeMap[$class][$attribute->getName()][] = $attribute->newInstance();
        }

        return $this->attributeMap[$class][$attributeClass] ?? [];
    }
}
