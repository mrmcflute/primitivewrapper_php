<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Wrappers\String\Transformers;

use PrimitiveWrapper\Attributes\AsMethod;
use PrimitiveWrapper\Builders\InterpolatedFormatBuilder;
use PrimitiveWrapper\Transformer\BuilderTransformer;
use PrimitiveWrapper\Validator\ArgumentCollection;
use PrimitiveWrapper\Wrappers\Wrapper;

#[AsMethod(methodName: 'format')]
class Format implements BuilderTransformer
{
    use ExpectedPrimitiveTypeString;

    /**
     * @param Wrapper $wrapper
     * @param ArgumentCollection $argumentCollection
     * @param array $args
     * @return InterpolatedFormatBuilder
     */
    public function transform(Wrapper $wrapper, ArgumentCollection $argumentCollection, array $args): InterpolatedFormatBuilder
    {
        return new InterpolatedFormatBuilder($wrapper);
    }
}
