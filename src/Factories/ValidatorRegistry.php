<?php
declare(strict_types=1);

namespace PrimitiveWrapper\Factories;

use PrimitiveWrapper\Validator\ValidationTree\LogicalNodes\LogicalNode;
use PrimitiveWrapper\Validator\ValidationTree\PropertyValidators\DefaultValidator;
use PrimitiveWrapper\Validator\ValidationTree\PropertyValidators\PropertyValidator;
use PrimitiveWrapper\Validator\Validator;

class ValidatorRegistry implements RegistryInterface
{
    use InterfaceValidationTrait;
    use GetMethodNameTrait;

    private array $validatorMap = [];

    private DefaultValidator $defaultValidator;

    /**
     * @param class-string<Validator> $object
     * @param string|null $key
     * @return RegistryInterface
     */
    public function bind($object, ?string $key = null): RegistryInterface
    {
        self::validateClassImplementsInterface($object, PropertyValidator::class);

        if (is_subclass_of($object, LogicalNode::class)) {
            return $this;
        }

        $methodName = $this->getMethodName($object);

        if (null !== $methodName) {
            $this->validatorMap[$methodName] = $object;
        }

        return $this;
    }

    public function get(string $key): ?PropertyValidator
    {
        $args = func_get_args();
        array_shift($args);

        $validatorClass = $this->validatorMap[$key] ?? null;

        return $validatorClass
            ? new $validatorClass(...$args)
            : null;
    }
}
