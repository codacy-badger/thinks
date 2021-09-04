<?php

namespace IsaEken\Thinks\Tests;

use IsaEken\Thinks\Tests\Mock\Attribute;
use PHPUnit\Framework\TestCase;

class AttributeTest extends TestCase
{
    public function test()
    {
        $attribute = new Attribute;
        $attribute->fill(['a' => 1, 'b' => 2]);
        $this->assertTrue($attribute->hasAttribute('a'));
        $attribute->guard()->fill(['c' => 3]);
        $this->assertFalse($attribute->hasAttribute('c'));
    }
}
