<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Wrappers\Array;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use PrimitiveWrapper\Attributes\AsMethod;
use PrimitiveWrapper\Wrappers\AbstractWrapperClass;
use PrimitiveWrapper\Wrappers\String\StringWrapper;
use Traversable;

/**
 * @method ArrayWrapper reverse()
 * @method StringWrapper join(string|null $separator = null)
 */
#[AsMethod(methodName: 'array', description: 'A wrapper around an array')]
class ArrayWrapper extends AbstractWrapperClass implements ArrayAccess, IteratorAggregate, Countable
{
    function transformValue(mixed $value): array
    {
        return (array) $value;
    }

    public function unwrap(): array
    {
        return $this->value;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
        return $this->value;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->value);
    }

    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->value);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->value[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        null === $offset
            ? $this->value[] = $value
            : $this->value[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->value[$offset]);
    }

    public function count(): int
    {
        return count($this->value);
    }

    public static function getPrimitiveType(): string
    {
        return 'array';
    }
}
