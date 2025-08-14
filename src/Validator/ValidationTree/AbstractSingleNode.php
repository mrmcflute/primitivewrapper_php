<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Validator\ValidationTree;

use PrimitiveWrapper\Validator\ValidationTree\LogicalNodes\LogicalNode;
use PrimitiveWrapper\Validator\ValidationTree\PropertyValidators\PropertyValidator;

abstract class AbstractSingleNode implements LogicalNode
{
    protected LogicalNode|PropertyValidator $node;

    public function __construct(private readonly LogicalNode $parentNode)
    {
    }

    public function addChildNode(PropertyValidator $node): LogicalNode
    {
        $this->node = $node;

        return $this;
    }

    public function getParentNode(): LogicalNode
    {
        return $this->parentNode;
    }

    public function getChildNodes(): array
    {
        return [$this->node];
    }
}