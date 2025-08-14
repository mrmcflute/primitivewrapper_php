<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Builders;

use PrimitiveWrapper\Exceptions\Builder\InterpolatedFormatBuilder\InvalidStringFormatException;
use PrimitiveWrapper\Exceptions\Builder\InterpolatedFormatBuilder\InvalidVariableException;
use PrimitiveWrapper\Wrappers\String\StringWrapper;
use PrimitiveWrapper\Wrappers\Wrapper;

class InterpolatedFormatBuilder implements Builder
{
    public const string PLACEHOLDER_REGEX = '/{{\s*(\w+)\s*}}/';

    /**
     * @var array<string, int>
     */
    private array $variablePositions = [];

    /**
     * @var array<string, mixed>
     */
    private array $variableBinds = [];

    private readonly string $value;

    public function __construct(Wrapper $value)
    {
        $this->value = $value->unwrap();

        $this->buildVariablePositions();
    }

    public function setVariableValue(string $variableName, string|Wrapper $value): static
    {
        if ($value instanceof Wrapper) {
            $value = $value->unwrap();
        }

        if (!array_key_exists($variableName, $this->variablePositions)) {
            throw new InvalidVariableException('Invalid Variable Name ' . $variableName);
        }

        $this->variableBinds[$variableName] = $value;

        return $this;
    }

    private function buildVariablePositions(): void
    {
        $matches = [];
        preg_match_all(self::PLACEHOLDER_REGEX, $this->value, $matches);

        if (empty($matches) || !isset($matches[1])) {
            throw new InvalidStringFormatException('Invalid interpolation string provided');
        }

        foreach ($matches[1] as $variable) {
            $this->variablePositions[$variable] ??= count($this->variablePositions) + 1;
        }
    }

    public function render(): StringWrapper
    {
        $formatString = preg_replace_callback(self::PLACEHOLDER_REGEX, function (array $match): string {
            $variable = $match[1];

            if (!isset($this->variablePositions[$variable])) {
                throw new InvalidVariableException("Unknown variable: $variable");
            }

            $position = $this->variablePositions[$variable];
            return '%' . $position . '$s';
        }, $this->value);

        // Sort the bind values in the correct order
        $orderedValues = array_fill(0, count($this->variablePositions), '');
        foreach ($this->variablePositions as $var => $pos) {
            $orderedValues[$pos - 1] = $this->variableBinds[$var];
        }

        return new StringWrapper(vsprintf($formatString, $orderedValues));
    }
}
