<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Validator\ValidationTree\LogicalNodes;

use PrimitiveWrapper\Validator\ValidationTree\AbstractNodeCollection;

class OrNode extends AbstractNodeCollection
{

    public function isValid(mixed $value): bool
    {
        foreach ($this->getChildNodes() as $node) {
            if ($node->isValid($value)) {
                return true;
            }
        }

        return false;
    }
}