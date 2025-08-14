<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Factories;

use InvalidArgumentException;
use PrimitiveWrapper\Wrappers\Wrapper;

class DefaultWrapperFactoryRegistry implements RegistryInterface
{
    use InterfaceValidationTrait;

    /**
     * @var array<class-string<Wrapper>, TransformerFactory>
     */
    private array $wrapperTransformerMap = [];

    /**
     * @param TransformerFactory $object
     * @param class-string<Wrapper>|null $key
     * @return RegistryInterface
     */
    public function bind($object, ?string $key = null): RegistryInterface
    {
        self::validateClassImplementsInterface($key, Wrapper::class);
        self::validateObjectIsOfClass($object, TransformerFactory::class);

        $this->wrapperTransformerMap[$key] = $object;

        return $this;
    }

    /**
     * @param class-string<Wrapper> $key
     * @return TransformerFactory
     */
    public function get(string $key): TransformerFactory
    {
        self::validateClassImplementsInterface($key, Wrapper::class);

        return $this->wrapperTransformerMap[$key] ??
            throw new InvalidArgumentException(sprintf('Key %s has not been defined', $key));
    }
}
