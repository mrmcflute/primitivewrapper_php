<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Validator\ValidationTree\PropertyValidators;

use PrimitiveWrapper\Attributes\AsMethod;
use PrimitiveWrapper\Validator\ValidationTree\PropertyValidators\PropertyValidator;

#[AsMethod(methodName: 'boolean')]
class BooleanValidator implements PropertyValidator
{

    public function isValid(mixed $value): bool
    {
        return boolval($value);
    }
}
