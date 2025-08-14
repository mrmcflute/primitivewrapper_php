<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Wrappers\Number;

use PrimitiveWrapper\Attributes\AsMethod;
use PrimitiveWrapper\Wrappers\AbstractWrapperClass;

#[AsMethod(methodName: 'number', description: 'A wrapper around an number')]
class NumberWrapper extends AbstractWrapperClass
{
    function transformValue(mixed $value): float
    {
        return floatval($value);
    }

    public static function getPrimitiveType(): string
    {
        return 'float';
    }

    public function unwrap(): float
    {
        return $this->value;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): string
    {
        return (string) $this->value;
    }
}