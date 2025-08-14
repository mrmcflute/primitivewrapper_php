<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Validator\ValidationTree\PropertyValidators;

interface PropertyValidator
{
    public function isValid(mixed $value): bool;
}
