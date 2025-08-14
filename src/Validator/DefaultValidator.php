<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Validator;

class DefaultValidator implements Validator
{

    /**
     * @inheritDoc
     */
    public function getMinArgCount(): ?int
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getMaxArgCount(): ?int
    {
        return null;
    }

    public function getValidationMap(): array
    {
        return [];
    }

    public function validate(array $args): void
    {
        // no action taken as the default validator will always work
    }
}