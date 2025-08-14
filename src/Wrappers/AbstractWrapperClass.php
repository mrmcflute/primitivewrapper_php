<?php
declare(strict_types=1);

namespace PrimitiveWrapper\Wrappers;

use PrimitiveWrapper\Builders\Builder;
use PrimitiveWrapper\Container;
use PrimitiveWrapper\Factories\TransformerFactory;

abstract class AbstractWrapperClass implements Wrapper
{
    private TransformerFactory $factory;

    protected mixed $value;

    abstract function transformValue(mixed $value);

    public function __construct(mixed $value, ?TransformerFactory $factory = null)
    {
        $this->factory = $factory ?? static::getDefaultFactory();

        $this->value = $this->transformValue($value);
    }

    public function withFactory(TransformerFactory $factory): static
    {
        return new static($this->value, $factory);
    }

    public function __call(string $name, array $arguments): Wrapper|Builder
    {
        return $this->factory->run($name, $this, $arguments);
    }

    public function getFactory(): TransformerFactory
    {
        return $this->factory;
    }

    public static function from($value, ?TransformerFactory $factory = null): Wrapper
    {
        return new static($value, $factory);
    }

    public static function getDefaultFactory(): TransformerFactory
    {
        return Container::getContainer()
            ->getDefaultWrapperFactoryRegistry()
            ->get(static::class);
    }

    public static function setDefaultFactory(TransformerFactory $factory): void
    {
        Container::getContainer()
            ->getDefaultWrapperFactoryRegistry()
            ->bind($factory, static::class);
    }
}
