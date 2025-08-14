<?php
declare(strict_types=1);

namespace PrimitiveWrapper\Wrappers\String\Transformers;

use PrimitiveWrapper\Attributes\AsMethod;
use PrimitiveWrapper\Transformer\PrimitiveTransformer;
use PrimitiveWrapper\Validator\ArgumentCollection;
use PrimitiveWrapper\Wrappers\String\StringWrapper;
use PrimitiveWrapper\Wrappers\Wrapper;

#[AsMethod(methodName: 'toLower')]
class LowerCase implements PrimitiveTransformer
{
    use ExpectedPrimitiveTypeString;

    /**
     * @param Wrapper $wrapper
     * @param ArgumentCollection $argumentCollection
     * @param array $args
     * @return string
     */
    public function transform(Wrapper $wrapper, ArgumentCollection $argumentCollection, array $args): string
    {
        return strtolower($wrapper->unwrap());
    }

    public function getDestinationWrapperClass(): string
    {
        return StringWrapper::class;
    }
}
