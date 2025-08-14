<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Validator\ValidationTree;

use InvalidArgumentException;
use PrimitiveWrapper\Container;
use PrimitiveWrapper\Validator\ValidationTree\LogicalNodes\AndNode;
use PrimitiveWrapper\Validator\ValidationTree\LogicalNodes\IsNode;
use PrimitiveWrapper\Validator\ValidationTree\LogicalNodes\LogicalNode;
use PrimitiveWrapper\Validator\ValidationTree\LogicalNodes\NotNode;
use PrimitiveWrapper\Validator\ValidationTree\LogicalNodes\OrNode;

/**
 * @method ExpressionBuilder array()
 * @method ExpressionBuilder string()
 * @method ExpressionBuilder float()
 * @method ExpressionBuilder integer()
 * @method ExpressionBuilder boolean()
 * @method ExpressionBuilder classInstance(string $class)
 */
readonly class ExpressionBuilder
{
    public static function new(): ExpressionBuilder
    {
        return new self(new RootNode());
    }

    public function __construct(private LogicalNode $rootNode)
    {
    }

    public function is(): ExpressionBuilder
    {
        return $this->newNode(IsNode::class);
    }

    public function and(): ExpressionBuilder
    {
        return $this->newNode(AndNode::class);
    }

    public function or(): ExpressionBuilder
    {
        return $this->newNode(OrNode::class);
    }

    public function not(): ExpressionBuilder
    {
        return $this->newNode(NotNode::class);
    }

    public function __call(string $name, array $arguments): ExpressionBuilder
    {
        $validator = Container::getContainer()
            ->getValidatorRegistry()
            ->get($name, $arguments)
            ?? throw new InvalidArgumentException('Invalid Argument ' . $name);

        $this->rootNode->addChildNode($validator);

        return $this;
    }

    /**
     * @param class-string<LogicalNode> $class
     * @return ExpressionBuilder
     */
    private function newNode(string $class): ExpressionBuilder
    {
        $arguments = func_get_args();

        return new self(new $class($this->rootNode, ...$arguments));
    }

    public function end(): ExpressionBuilder
    {
        if ($this->rootNode instanceof RootNode) {
            return $this;
        }

        return new self($this->rootNode->getParentNode());
    }

    public function getRootNode(): RootNode
    {
        $node = $this->rootNode;

        while (!($node instanceof RootNode)) {
            $node = $node->getParentNode();
        }

        return $node;
    }
}
