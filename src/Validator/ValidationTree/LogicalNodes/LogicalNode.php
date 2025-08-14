<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Validator\ValidationTree\LogicalNodes;

use PrimitiveWrapper\Validator\ValidationTree\PropertyValidators\PropertyValidator;

interface LogicalNode extends PropertyValidator
{
    public function getParentNode(): LogicalNode;

    /**
     * @return PropertyValidator[]
     */
    public function getChildNodes(): array;

    /**
     * @param PropertyValidator $node
     * @return self
     */
    public function addChildNode(PropertyValidator $node): self;
}
