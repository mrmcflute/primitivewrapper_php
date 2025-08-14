<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Validator\ValidationTree\PropertyValidators;


use PrimitiveWrapper\Attributes\AsMethod;

#[AsMethod(methodName: 'class')]
readonly class ClassValidator implements PropertyValidator
{
    public function __construct(private string $class)
    {
    }

    public function isValid(mixed $value): bool
    {
        return $value instanceof $this->class;
    }
}