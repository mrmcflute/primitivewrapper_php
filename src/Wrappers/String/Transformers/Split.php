<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Wrappers\String\Transformers;

use PrimitiveWrapper\Attributes\AsMethod;
use PrimitiveWrapper\Attributes\WithArgument;
use PrimitiveWrapper\Transformer\PrimitiveTransformer;
use PrimitiveWrapper\Validator\ArgumentCollection;
use PrimitiveWrapper\Validator\ValidatorType;
use PrimitiveWrapper\Wrappers\Array\ArrayWrapper;
use PrimitiveWrapper\Wrappers\Wrapper;

#[AsMethod('split')]
#[WithArgument(name: 'separator', validator: ValidatorType::String, isRequired: true, defaultValue: ' ')]
class Split implements PrimitiveTransformer
{
    use ExpectedPrimitiveTypeString;

    /**
     * @inheritDoc
     */
    public function getDestinationWrapperClass(): string
    {
        return ArrayWrapper::class;
    }

    public function transform(Wrapper $wrapper, ArgumentCollection $argumentCollection, array $args): string|int|float|array|null
    {
        return explode($argumentCollection->getArgument('separator', $args), $wrapper->unwrap());
    }
}