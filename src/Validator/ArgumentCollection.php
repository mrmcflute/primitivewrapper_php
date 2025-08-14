<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Validator;

use PrimitiveWrapper\Attributes\WithArgument;
use PrimitiveWrapper\Exceptions\Transformer\InvalidArgumentException;
use PrimitiveWrapper\Exceptions\Transformer\MissingRequiredArgumentException;
use PrimitiveWrapper\Exceptions\Validator\InvalidValueException;

class ArgumentCollection
{
    private array $argumentAttributes = [];

    private array $argumentPosition;

    /**
     * @param WithArgument[] $argumentAttributes
     */
    public function __construct(array $argumentAttributes = [])
    {
        foreach ($argumentAttributes as $idx => $argumentAttribute) {
            $this->argumentAttributes[$argumentAttribute->name] = $argumentAttribute;
            $this->argumentPosition[$argumentAttribute->name] = $idx;
        }
    }

    public function getArgument(string $argumentName, array $args): mixed
    {
        /** @var WithArgument $argumentAttribute */
        $argumentAttribute = $this->argumentAttributes[$argumentName]
            ?? throw new InvalidArgumentException(sprintf('Unknown argument %s', $argumentName));

        $argumentPosition = $this->argumentPosition[$argumentAttribute->name];

        $argument =
            $args[$argumentAttribute->name] ??
            $args[$argumentPosition] ?? null;

        $returnValue = $argument ?? $argumentAttribute->defaultValue;

        if ($returnValue === null && $argumentAttribute->isRequired) {
            throw new MissingRequiredArgumentException(
                sprintf(
                    'Argument %s (position %s) is required',
                    $argumentAttribute->name,
                    $argumentPosition
                )
            );
        }

        if (!$argumentAttribute->validator->isValid($returnValue)) {
            throw new InvalidValueException(
                sprintf('Invalid Argument supplied for %s', $argumentAttribute->name));
        }

        return $argument ?? $argumentAttribute->defaultValue;
    }
}
