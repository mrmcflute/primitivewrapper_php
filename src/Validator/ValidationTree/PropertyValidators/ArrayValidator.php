<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Validator\ValidationTree\PropertyValidators;

use PrimitiveWrapper\Attributes\AsMethod;

#[AsMethod(methodName: 'array')]
class ArrayValidator implements PropertyValidator
{
    public function isValid(mixed $value): bool
    {
        return is_array($value);
    }
}
