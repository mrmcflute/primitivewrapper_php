<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Wrappers\Array\Transformers;

use PrimitiveWrapper\Transformer\Transformer;
use PrimitiveWrapper\Wrappers\Array\ArrayWrapper;

/**
 * @mixin Transformer
 */
trait ExpectedWrapperArray
{
    public static function getExpectedPrimitiveType(): string
    {
        return 'array';
    }
}
