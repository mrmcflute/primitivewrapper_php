<?php
declare(strict_types=1);

namespace PrimitiveWrapper\Wrappers\Number\Transformers;

use PrimitiveWrapper\Attributes\AsMethod;
use PrimitiveWrapper\Transformer\PrimitiveTransformer;
use PrimitiveWrapper\Validator\ArgumentCollection;
use PrimitiveWrapper\Wrappers\String\StringWrapper;
use PrimitiveWrapper\Wrappers\Wrapper;

#[AsMethod('toString')]
class ToString implements PrimitiveTransformer
{
    /**
     * @inheritDoc
     */
    public function getDestinationWrapperClass(): string
    {
        return StringWrapper::class;
    }

    /**
     * @inheritDoc
     */
    public function transform(Wrapper $wrapper, ArgumentCollection $argumentCollection, array $args): string|int|float|array|null
    {
        return (string) $wrapper->unwrap();
    }

    public static function getExpectedPrimitiveType(): string
    {
        return 'float';
    }
}