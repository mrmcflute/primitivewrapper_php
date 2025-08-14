<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Validator\ValidationTree\PropertyValidators;

use PrimitiveWrapper\Attributes\AsMethod;

#[AsMethod('string')]
class StringValidator implements PropertyValidator
{
    public function isValid(mixed $value): bool
    {
        return is_string($value) || (is_object($value) && method_exists($value, '__toString'));
    }
}
