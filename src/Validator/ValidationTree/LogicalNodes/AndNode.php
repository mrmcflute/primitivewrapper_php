<?php
declare(strict_types=1);

namespace PrimitiveWrapper\Validator\ValidationTree\LogicalNodes;

use PrimitiveWrapper\Validator\ValidationTree\AbstractNodeCollection;

class AndNode extends AbstractNodeCollection
{

    public function isValid(mixed $value): bool
    {
        foreach ($this->getChildNodes() as $node) {
            if (!$node->isValid($value)) {
                return false;
            }
        }

        return true;
    }
}