<?php
declare(strict_types=1);

namespace PrimitiveWrapper\Wrappers\Array\Transformers;

use PrimitiveWrapper\Attributes\AsMethod;
use PrimitiveWrapper\Transformer\PrimitiveTransformer;
use PrimitiveWrapper\Validator\ArgumentCollection;
use PrimitiveWrapper\Wrappers\Array\ArrayWrapper;
use PrimitiveWrapper\Wrappers\Wrapper;

#[AsMethod('reverse')]
class Reverse implements PrimitiveTransformer
{
    use ExpectedWrapperArray;

    /**
     * @inheritDoc
     */
    public function getDestinationWrapperClass(): string
    {
        return ArrayWrapper::class;
    }

    /**
     * @param Wrapper $wrapper
     * @param ArgumentCollection $argumentCollection
     * @param array $args
     * @return string|int|float|array|null
     */
    public function transform(Wrapper $wrapper, ArgumentCollection $argumentCollection, array $args): string|int|float|array|null
    {
        return array_reverse($wrapper->unwrap());
    }
}
