<?php
declare(strict_types=1);

namespace PrimitiveWrapper\Builders;

use PrimitiveWrapper\Wrappers\Wrapper;

interface Builder
{
    public function __construct(Wrapper $value);

    public function render(): Wrapper;
}