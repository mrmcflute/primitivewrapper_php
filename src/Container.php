<?php

declare(strict_types=1);

namespace PrimitiveWrapper;

use PrimitiveWrapper\Factories\AttributeCache;
use PrimitiveWrapper\Factories\DefaultWrapperFactoryRegistry;
use PrimitiveWrapper\Factories\TransformerValidatorRegistry;
use PrimitiveWrapper\Factories\ValidatorRegistry;
use PrimitiveWrapper\Wrappers\WrapperFactory;

class Container
{
    private static Container $container;

    public static function getContainer(): Container
    {
        return self::$container ??= new Container();
    }

    private AttributeCache $attributeCache;

    private DefaultWrapperFactoryRegistry $defaultWrapperFactoryRegistry;

    private TransformerValidatorRegistry $transformerValidatorRegistry;

    private ValidatorRegistry $validatorRegistry;

    private WrapperFactory $wrapperFactory;

    public function __construct()
    {
        $this->defaultWrapperFactoryRegistry = new DefaultWrapperFactoryRegistry();
        $this->transformerValidatorRegistry = new TransformerValidatorRegistry();
        $this->validatorRegistry = new ValidatorRegistry();
        $this->attributeCache = new AttributeCache();
        $this->wrapperFactory = new WrapperFactory();

    }

    public function getAttributeCache(): AttributeCache
    {
        return $this->attributeCache;
    }

    public function getDefaultWrapperFactoryRegistry(): DefaultWrapperFactoryRegistry
    {
        return $this->defaultWrapperFactoryRegistry;
    }

    public function getTransformerValidatorRegistry(): TransformerValidatorRegistry
    {
        return $this->transformerValidatorRegistry;
    }

    public function getValidatorRegistry(): ValidatorRegistry
    {
        return $this->validatorRegistry;
    }

    public function getWrapperFactory(): WrapperFactory
    {
        return $this->wrapperFactory;
    }
}
