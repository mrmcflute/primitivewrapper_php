<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Attributes;

use Attribute;
use PrimitiveWrapper\Validator\ValidationTree\ExpressionBuilder;
use PrimitiveWrapper\Validator\ValidationTree\RootNode;
use PrimitiveWrapper\Validator\ValidatorType;

#[Attribute(flags: Attribute::TARGET_CLASS|Attribute::IS_REPEATABLE)]
readonly class WithArgument
{
    public RootNode $validator;

    public function __construct(
        public string $name,
        ValidatorType|ExpressionBuilder|RootNode $validator,
        public bool $isRequired = false,
        public string $description = '',
        public mixed $defaultValue = null
    ) {
        $this->validator = $this->getRootNode($validator);

        $this->validator->setIsRequired($this->isRequired);
    }

    private function getRootNode(ValidatorType|ExpressionBuilder|RootNode $validator)
    {
        if ($validator instanceof ValidatorType) {
            return $validator->getRootNode();
        }

        if ($validator instanceof ExpressionBuilder) {
            return $validator->getRootNode();
        }

        return $validator;
    }
}
