<?php
declare(strict_types=1);

namespace PrimitiveWrapper\Transformer;

use PrimitiveWrapper\Validator\ArgumentCollection;
use PrimitiveWrapper\Wrappers\Wrapper;

interface PrimitiveTransformer extends Transformer
{
    /**
     * @return class-string<Wrapper>
     */
    public function getDestinationWrapperClass(): string;

    /**
     * @param Wrapper $wrapper
     * @param ArgumentCollection $argumentCollection
     * @param array $args
     * @return string|int|float|array|null
     */
    public function transform(Wrapper $wrapper, ArgumentCollection $argumentCollection, array $args): string|int|float|array|null;
}