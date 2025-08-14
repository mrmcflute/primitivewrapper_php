<?php
declare(strict_types=1);

namespace PrimitiveWrapper\Validator\ValidationTree\LogicalNodes;

use PrimitiveWrapper\Validator\ValidationTree\AbstractSingleNode;

class NotNode extends AbstractSingleNode
{
    public function isValid(mixed $value): bool
    {
        return !$this->node->isValid($value);
    }
}
