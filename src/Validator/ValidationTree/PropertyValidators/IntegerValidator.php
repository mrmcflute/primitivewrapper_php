<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Validator\ValidationTree\PropertyValidators;

use PrimitiveWrapper\Attributes\AsMethod;

#[AsMethod('integer')]
class IntegerValidator implements PropertyValidator
{

    public function isValid(mixed $value): bool
    {
        return is_int($value);
    }
}