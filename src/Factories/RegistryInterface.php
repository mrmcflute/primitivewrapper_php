<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Factories;

interface RegistryInterface
{
    public function bind($object, ?string $key = null): self;

    public function get(string $key);
}
