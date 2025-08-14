<?php
declare(strict_types=1);

namespace PrimitiveWrapper\Wrappers\String\Transformers;

use PrimitiveWrapper\Transformer\Transformer;
use PrimitiveWrapper\Wrappers\String\StringWrapper;

/**
 * @mixin Transformer
 */
trait ExpectedPrimitiveTypeString
{
    public static function getExpectedPrimitiveType(): string
    {
        return 'string';
    }
}