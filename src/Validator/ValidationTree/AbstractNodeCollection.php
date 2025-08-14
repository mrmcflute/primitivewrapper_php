<?php
declare(strict_types=1);

namespace PrimitiveWrapper\Validator\ValidationTree;

use Countable;
use PrimitiveWrapper\Validator\ValidationTree\LogicalNodes\LogicalNode;
use PrimitiveWrapper\Validator\ValidationTree\PropertyValidators\PropertyValidator;

abstract class AbstractNodeCollection implements LogicalNode, Countable
{
    private array $nodes = [];

    public function __construct(private readonly LogicalNode $parentNode)
    {
    }

    public function getParentNode(): LogicalNode
    {
        return $this->parentNode;
    }

    /**
     * @return (PropertyValidator|LogicalNode)[]
     */
    public function getChildNodes(): array
    {
        return $this->nodes;
    }

    public function addChildNode(LogicalNode|PropertyValidator $node): LogicalNode
    {
        $this->nodes[] = $node;

        return $this;
    }

    public function count(): int
    {
        return count($this->nodes);
    }
}