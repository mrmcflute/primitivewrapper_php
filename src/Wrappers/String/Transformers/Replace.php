<?php
declare(strict_types=1);

namespace PrimitiveWrapper\Wrappers\String\Transformers;

use PrimitiveWrapper\Attributes\AsMethod;
use PrimitiveWrapper\Attributes\WithArgument;
use PrimitiveWrapper\Transformer\PrimitiveTransformer;
use PrimitiveWrapper\Validator\ArgumentCollection;
use PrimitiveWrapper\Validator\ValidatorType;
use PrimitiveWrapper\Wrappers\String\StringWrapper;
use PrimitiveWrapper\Wrappers\Wrapper;

#[AsMethod('replace')]
#[WithArgument(name: 'search', validator: ValidatorType::String, isRequired: true)]
#[WithArgument(name: 'replace', validator: ValidatorType::String, isRequired: true)]
class Replace implements PrimitiveTransformer
{
    use ExpectedPrimitiveTypeString;

    public function getDestinationWrapperClass(): string
    {
        return StringWrapper::class;
    }

    public function transform(Wrapper $wrapper, ArgumentCollection $argumentCollection, array $args): string
    {
        $search = $argumentCollection->getArgument('search', $args);
        $replace = $argumentCollection->getArgument('replace', $args);

        return str_replace(
            search: $search,
            replace: $replace,
            subject: $wrapper->unwrap()
        );
    }
}
