<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Validator;

use PrimitiveWrapper\Validator\ValidationTree\ExpressionBuilder;
use PrimitiveWrapper\Validator\ValidationTree\RootNode;

enum ValidatorType: string
{
    case String = 'string';

    case Integer = 'integer';

    case Float = 'float';

    case Array = 'array';

    case Boolean = 'boolean';

    public function getRootNode(bool $isRequired = false): RootNode
    {
        $expr = ExpressionBuilder::new();

        $validator = match ($this) {
            self::String => $expr->string(),
            self::Integer => $expr->integer(),
            self::Float => $expr->float(),
            self::Array => $expr->array(),
            self::Boolean => $expr->boolean()
        };

        return $validator
            ->getRootNode()
            ->setIsRequired($isRequired);
    }
}
