<?php
declare(strict_types=1);

namespace PrimitiveWrapper\Validator;

use PrimitiveWrapper\Validator\ValidationTree\ExpressionBuilder;
use PrimitiveWrapper\Validator\ValidationTree\RootNode;

class ValidationValue
{
    private RootNode $node;

    /**
     * Disable publicly instantiating this. Use the 'from' static method
     * @see self::from()
     */
    private function __construct()
    {
    }

    public function setValidatorRootNode(ExpressionBuilder|RootNode $node, bool $isRequired): static
    {
        $this->node = $node instanceof ExpressionBuilder
            ? $node->getRootNode()
            : $node;

        $this->node->setIsRequired($isRequired);

        return $this;
    }

    public static function from(ExpressionBuilder|RootNode $node, bool $isRequired = true): ValidationValue
    {
        return (new self())
            ->setValidatorRootNode($node, $isRequired);
    }

    public function validate(mixed $value): bool
    {
        return $this->node->isValid($value);
    }
}
