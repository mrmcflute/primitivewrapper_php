<?php
declare(strict_types=1);

namespace PrimitiveWrapper\Transformer;


use PrimitiveWrapper\Validator\ArgumentCollection;
use PrimitiveWrapper\Wrappers\Wrapper;

interface Transformer
{
    public static function getExpectedPrimitiveType(): string;

    /**
     * @param Wrapper $wrapper
     * @param ArgumentCollection $argumentCollection
     * @param array $args
     */
    public function transform(Wrapper $wrapper, ArgumentCollection $argumentCollection, array $args);
}
