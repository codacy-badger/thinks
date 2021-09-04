<?php

namespace IsaEken\Thinks\Tests;

use Illuminate\Support\Carbon;
use IsaEken\Thinks\Tests\Mock\Cast;
use PHPUnit\Framework\TestCase;

class CastTest extends TestCase
{
    public function test()
    {
        $cast = new Cast;
        $cast->setCasts([
            'my_name_is' => 'string',
            'testing' => 'bool',
            'age' => 'integer',
            'float' => 'float',
            'double' => 'double',
            'birth_date' => 'datetime',
            'list' => 'array',
        ]);

        $this->assertEquals('strval', $cast->getCast('xd'));
        $this->assertEquals('intval', $cast->getCast('xd', 'integer'));

        $this->assertEquals('İsa', $cast->cast('my_name_is', 'İsa'));
        $this->assertEquals(true, $cast->cast('testing', true));

        $this->assertEquals(true, $cast->cast('testing', 'true'));
        $this->assertEquals(false, $cast->cast('testing', 'false'));
        $this->assertEquals(true, $cast->cast('testing', 'testtt'));
        $this->assertEquals(true, $cast->cast('testing', 'yes'));
        $this->assertEquals(false, $cast->cast('testing', 'no'));
        $this->assertEquals(true, $cast->cast('testing', 'positive'));
        $this->assertEquals(false, $cast->cast('testing', 'negative'));
        $this->assertEquals(true, $cast->cast('testing', '1'));
        $this->assertEquals(false, $cast->cast('testing', '0'));
        $this->assertEquals(true, $cast->cast('testing', '46'));

        $this->assertEquals(5, $cast->cast('age', 5));
        $this->assertEquals(5, $cast->cast('age', '5'));
        $this->assertEquals(5, $cast->cast('age', fn () => 2 + 3));

        $this->assertEquals(4.4, $cast->cast('float', 4.4));
        $this->assertEquals(4.4, $cast->cast('double', 4.4));

        $this->assertEquals(Carbon::make('04/10/2002'), $cast->cast('birthdate', Carbon::make('10 April 2002')));

        $this->assertEquals(['a', 'b'], $cast->cast('list', ['a', 'b']));
        $this->assertEquals(['a', 'b'], $cast->cast('list', '["a", "b"]'));
    }
}
