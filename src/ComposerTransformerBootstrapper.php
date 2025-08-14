<?php

declare(strict_types=1);

namespace PrimitiveWrapper;

use PrimitiveWrapper\Factories\FactoryTransformerRegistry;
use PrimitiveWrapper\Transformer\Transformer;
use PrimitiveWrapper\Validator\ValidationTree\PropertyValidators\PropertyValidator;
use PrimitiveWrapper\Wrappers\Wrapper;
use ReflectionClass;

class ComposerTransformerBootstrapper
{
    public static function boot(): void
    {
        (new self())
            ->bootPrimitiveWrapper();
    }

    public function bootPrimitiveWrapper(): void
    {
        DirectoryScanner::requireAllPHPFiles(__DIR__);

        $this->registerValidators();

        $this->buildWrappers();
    }

    private function buildWrappers(): void
    {
        /**
         * @var array<string, class-string<Wrapper>>[] $wrapperPrimitives
         */
        $wrapperPrimitives = [];

        /** @var array<class-string<Wrapper>, FactoryTransformerRegistry $transfomerRegistries */
        $transformerRegistries = [];

        /**
         * @var $class class-string<Wrapper>
         */
        foreach ($this->getInterfaceClasses(Wrapper::class) as $class) {
            if ((new ReflectionClass($class))->isAbstract()) {
                continue;
            }

            $this->getContainer()
                ->getWrapperFactory()
                ->bind($class);

            $primitive = $class::getPrimitiveType();

            $wrapperPrimitives[$primitive] ??= [];
            $wrapperPrimitives[$primitive][] = $class;
        }

        /**
         * @var $transformerClass class-string<Transformer>
         */
        foreach ($this->getInterfaceClasses(Transformer::class) as $transformerClass)
        {
            $expectedPrimitive = $transformerClass::getExpectedPrimitiveType();

            /** @var  $wrapperClass class-string<Wrapper> */
            foreach ($wrapperPrimitives[$expectedPrimitive] as $wrapperClass) {
                $registry = $transformerRegistries[$wrapperClass]
                    ??= $this->getContainer()
                    ->getDefaultWrapperFactoryRegistry()
                    ->get($wrapperClass)
                    ->getTransformerRegistry();

                $registry->bind($transformerClass);
            }
        }
    }

    private function registerValidators(): void
    {
        foreach (get_declared_classes() as $class) {
            $reflection = new ReflectionClass($class);
            if ($reflection->isAbstract() || !$reflection->implementsInterface(PropertyValidator::class)) {
                continue;
            }

            $this->getContainer()->getValidatorRegistry()->bind($class);
        }
    }

    /**
     * @param class-string $interface
     * @return string[]
     */
    private function getInterfaceClasses(string $interface): array
    {
        return array_filter(get_declared_classes(), fn(string $class) => is_subclass_of($class, $interface));
    }

    private function getContainer(): Container
    {
        return Container::getContainer();
    }
}
