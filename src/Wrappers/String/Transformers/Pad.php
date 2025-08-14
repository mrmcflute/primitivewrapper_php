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

#[AsMethod(methodName: 'pad')]
#[WithArgument('length', ValidatorType::Integer, isRequired: true)]
#[WithArgument('pad_string', ValidatorType::String, isRequired: true, defaultValue:  ' ')]
#[WithArgument('pad_type', ValidatorType::Integer, isRequired: true, defaultValue: STR_PAD_RIGHT)]
class Pad implements PrimitiveTransformer
{
    use ExpectedPrimitiveTypeString;

    public function __construct()
    {
    }

    public function getDestinationWrapperClass(): string
    {
        return StringWrapper::class;
    }

    public function transform(Wrapper $wrapper, ArgumentCollection $argumentCollection, array $args): string
    {
        $length = (int) $argumentCollection->getArgument('length', $args);
        $padString = (string) $argumentCollection->getArgument('pad_string', $args);
        $padType = (int) $argumentCollection->getArgument('pad_type', $args);

        return str_pad(
            string: $wrapper->unwrap(),
            length: $length,
            pad_string: $padString,
            pad_type: $padType
        );
    }
}
