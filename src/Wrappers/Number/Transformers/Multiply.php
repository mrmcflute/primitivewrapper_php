<?php
declare(strict_types=1);

namespace PrimitiveWrapper\Wrappers\Number\Transformers;

use PrimitiveWrapper\Attributes\AsMethod;
use PrimitiveWrapper\Attributes\WithArgument;
use PrimitiveWrapper\Transformer\PrimitiveTransformer;
use PrimitiveWrapper\Validator\ArgumentCollection;
use PrimitiveWrapper\Validator\ValidatorType;
use PrimitiveWrapper\Wrappers\Number\NumberWrapper;
use PrimitiveWrapper\Wrappers\Wrapper;

#[AsMethod('times')]
#[WithArgument('number', ValidatorType::Float, isRequired: true)]
class Multiply implements PrimitiveTransformer
{
    /**
     * @inheritDoc
     */
    public function getDestinationWrapperClass(): string
    {
        return NumberWrapper::class;
    }

    /**
     * @inheritDoc
     */
    public function transform(Wrapper $wrapper, ArgumentCollection $argumentCollection, array $args): string|int|float|array|null
    {
        return $wrapper->unwrap() * $argumentCollection->getArgument('number', $args);
    }

    public static function getExpectedPrimitiveType(): string
    {
        return 'float';
    }
}