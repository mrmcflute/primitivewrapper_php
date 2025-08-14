<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Validator\ValidationTree\PropertyValidators;

use PrimitiveWrapper\Attributes\AsMethod;

#[AsMethod(methodName: 'float')]
class FloatValidator implements PropertyValidator
{

    public function isValid(mixed $value): bool
    {
        return is_float($value) || is_int($value);
    }
}
