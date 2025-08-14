<?php
declare(strict_types=1);

namespace PrimitiveWrapper\Wrappers\String;

use PrimitiveWrapper\Attributes\AsMethod;
use PrimitiveWrapper\Builders\InterpolatedFormatBuilder;
use PrimitiveWrapper\Wrappers\AbstractWrapperClass;
use PrimitiveWrapper\Wrappers\Array\ArrayWrapper;
use Stringable;

/**
 * @method StringWrapper toUpper()
 * @method StringWrapper toLower()
 * @method StringWrapper replace(string $search, string $replace)
 * @method StringWrapper reverse()
 * @method StringWrapper pad(int $length, string|StringWrapper $padString, int $padType = STR_PAD_RIGHT)
 * @method InterpolatedFormatBuilder format()
 * @method ArrayWrapper split(string $separator = ' ')
 */
#[AsMethod(methodName: 'string', description: 'A wrapper around string')]
class StringWrapper extends AbstractWrapperClass implements Stringable
{
    public function unwrap(): string
    {
        return $this->value;
    }

    public function jsonSerialize(): mixed
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    function transformValue(mixed $value): string
    {
        return strval($value);
    }

    public static function getPrimitiveType(): string
    {
        return 'string';
    }
}
