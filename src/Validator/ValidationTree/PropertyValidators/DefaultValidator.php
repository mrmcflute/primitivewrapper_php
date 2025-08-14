<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Validator\ValidationTree\PropertyValidators;

/**
 * This is a fallback validator that will allow all. This is only used as a fallback and should not be used as part of
 * an actual validator
 */
class DefaultValidator implements PropertyValidator
{
    public function isValid(mixed $value): bool
    {
        return true;
    }
}