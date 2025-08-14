<?php
declare(strict_types=1);

namespace PrimitiveWrapper\Wrappers\String\Transformers;

use PrimitiveWrapper\Attributes\AsMethod;
use PrimitiveWrapper\Transformer\PrimitiveTransformer;
use PrimitiveWrapper\Validator\ArgumentCollection;
use PrimitiveWrapper\Wrappers\String\StringWrapper;
use PrimitiveWrapper\Wrappers\Wrapper;

#[AsMethod('toUpper')]
class UpperCase implements PrimitiveTransformer
{
    use ExpectedPrimitiveTypeString;

    public function getDestinationWrapperClass(): string
    {
        return StringWrapper::class;
    }

    public function transform(Wrapper $wrapper, ArgumentCollection $argumentCollection, array $args): string
    {
        return strtoupper($wrapper->unwrap());
    }
}
