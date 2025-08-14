<?php
declare(strict_types=1);

namespace PrimitiveWrapper\Validator;

use PrimitiveWrapper\Wrappers\Wrapper;

/**
 * @template WrapperClass of Wrapper
 */
interface Validator
{
    /**
     * The minimum number of arguments required. Leave this as NULL if there are no minimums
     * @return int|null
     */
    public function getMinArgCount(): ?int;

    /**
     * The maximum number of arguments required. Leave this as NULL if there are no maximums
     * @return int|null
     */
    public function getMaxArgCount(): ?int;

    /**
     * The validation values. This should be an array list, where each required argument is listed in order
     *
     * @return ValidationValue[]
     */
    public function getValidationMap(): array;

    public function validate(array $args): void;
}
