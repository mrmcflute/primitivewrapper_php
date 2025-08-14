<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Attributes;

use Attribute;

#[Attribute(flags: Attribute::TARGET_CLASS)]
readonly class AsMethod
{
    public function __construct(
        public string $methodName,
        public string $description = ''
    ) {
    }
}
