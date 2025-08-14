<?php
declare(strict_types=1);

namespace PrimitiveWrapper\Transformer;

use PrimitiveWrapper\Builders\Builder;
use PrimitiveWrapper\Validator\ArgumentCollection;
use PrimitiveWrapper\Wrappers\Wrapper;

interface BuilderTransformer extends Transformer
{
    /**
     * @param Wrapper $wrapper
     * @param ArgumentCollection $argumentCollection
     * @param array $args
     * @return Builder
     */
    public function transform(Wrapper $wrapper, ArgumentCollection $argumentCollection, array $args): Builder;
}