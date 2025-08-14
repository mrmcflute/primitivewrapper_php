<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Validator\ValidationTree;

use PrimitiveWrapper\Exceptions\Validator\NoParentNodeException;
use PrimitiveWrapper\Validator\ValidationTree\LogicalNodes\LogicalNode;
use PrimitiveWrapper\Validator\ValidationTree\PropertyValidators\PropertyValidator;

class RootNode implements LogicalNode
{
    /**
     * @var PropertyValidator[]
     */
    private array $nodes = [];

    private bool $isRequired = false;

    public function getParentNode(): LogicalNode
    {
        throw new NoParentNodeException();
    }

    public function isValid(mixed $value): bool
    {
        if ($value === null) {
            return $this->isRequired;
        }

        foreach ($this->getChildNodes() as $node) {
            if (!$node->isValid($value)) {
                return false;
            }
        }

        return true;
    }

    public function setIsRequired(bool $isRequired): RootNode
    {
        $this->isRequired = $isRequired;

        return $this;
    }

    public function addChildNode(PropertyValidator $node): LogicalNode
    {
        $this->nodes[] = $node;

        return $this;
    }

    public function count(): int
    {
        return count($this->nodes);
    }

    /**
     * @return PropertyValidator[]
     */
    public function getChildNodes(): array
    {
        return $this->nodes;
    }
}