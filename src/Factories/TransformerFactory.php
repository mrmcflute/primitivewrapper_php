<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Factories;

use PrimitiveWrapper\Builders\Builder;
use PrimitiveWrapper\Container;
use PrimitiveWrapper\Exceptions\InvalidClassException;
use PrimitiveWrapper\Transformer\BuilderTransformer;
use PrimitiveWrapper\Transformer\PrimitiveTransformer;
use PrimitiveWrapper\Wrappers\Wrapper;

final readonly class TransformerFactory
{
    public function __construct(private FactoryTransformerRegistry $transformerMap = new FactoryTransformerRegistry())
    {
    }

    public final function run(string $methodName, Wrapper $wrapper, array $arguments): Wrapper|Builder
    {
        $transformer = $this->transformerMap->get($methodName);

        $transformerClass = get_class($transformer);

        $argumentCollection = Container::getContainer()
            ->getTransformerValidatorRegistry()
            ->get($transformerClass);

        $expectedPrimitive = $transformer->getExpectedPrimitiveType();
        if ($wrapper->getPrimitiveType() !== $transformer->getExpectedPrimitiveType()) {
            throw new InvalidClassException(sprintf('Wrapper Class does not support transformer primitive. Expected %s. Got %s', $expectedPrimitive, $wrapper->getPrimitiveType()));
        }

        if ($transformer instanceof PrimitiveTransformer) {
            $rawValue = $transformer->transform($wrapper, $argumentCollection, $arguments);

            $newWrapperClass = $transformer->getDestinationWrapperClass();

            $newValue = new $newWrapperClass($rawValue);

            if ($newValue instanceof $wrapper) {
                $newValue = $newValue->withFactory($wrapper->getFactory());
            }

            return $newValue;
        }

        if ($transformer instanceof BuilderTransformer) {
            return $transformer->transform($wrapper, $argumentCollection, $arguments);
        }

        throw new InvalidClassException('Transformer class ' . $transformerClass . ' not recognised');
    }

    public final function getTransformerRegistry(): FactoryTransformerRegistry
    {
        return $this->transformerMap;
    }
}
