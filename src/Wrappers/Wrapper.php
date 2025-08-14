<?php

declare(strict_types=1);

namespace PrimitiveWrapper\Wrappers;

use JsonSerializable;
use PrimitiveWrapper\Builders\Builder;
use PrimitiveWrapper\Factories\TransformerFactory;

interface Wrapper extends JsonSerializable
{
    public function __construct(mixed $value, ?TransformerFactory $factory = null);

    public static function getPrimitiveType(): string;

    public function getFactory(): TransformerFactory;

    public function withFactory(TransformerFactory $factory): self;

    public function __call(string $name, array $arguments): Wrapper|Builder;

    public function unwrap();

    public static function from($value, ?TransformerFactory $factory = null): self;

    public static function getDefaultFactory(): TransformerFactory;

    public static function setDefaultFactory(TransformerFactory $factory): void;
}
