<?php

declare(strict_types=1);

namespace tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use PrimitiveWrapper\ComposerTransformerBootstrapper;
use PrimitiveWrapper\Wrappers\String\StringWrapper;

class StringWrapperTest extends TestCase
{
    public function setUp(): void
    {
        ComposerTransformerBootstrapper::boot();
    }

    #[Test]
    public function testUpper()
    {
        $str = new StringWrapper('hello');
        $this->assertSame('HELLO', $str->toUpper()->unwrap());
    }

    #[Test]
    public function testLower()
    {
        $str = new StringWrapper('Hello');
        $this->assertSame('hello', $str->toLower()->unwrap());
    }
}
