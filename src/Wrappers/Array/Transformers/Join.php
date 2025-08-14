<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Wrappers\Array\Transformers;

use PrimitiveWrapper\Attributes\AsMethod;
use PrimitiveWrapper\Attributes\WithArgument;
use PrimitiveWrapper\Transformer\PrimitiveTransformer;
use PrimitiveWrapper\Validator\ArgumentCollection;
use PrimitiveWrapper\Validator\ValidatorType;
use PrimitiveWrapper\Wrappers\String\StringWrapper;
use PrimitiveWrapper\Wrappers\Wrapper;

#[AsMethod(methodName: 'join')]
#[WithArgument(name: 'separator', validator: ValidatorType::String, defaultValue: ',')]
class Join implements PrimitiveTransformer
{
    use ExpectedWrapperArray;

    public function getDestinationWrapperClass(): string
    {
        return StringWrapper::class;
    }

    /**
     * @param Wrapper $wrapper
     * @param ArgumentCollection $argumentCollection
     * @param array $args
     * @return string|int|float|array|null
     */
    public function transform(Wrapper $wrapper, ArgumentCollection $argumentCollection, array $args): string|int|float|array|null
    {
        return implode($argumentCollection->getArgument('separator', $args), $wrapper->unwrap());
    }
}
