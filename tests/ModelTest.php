<?php

namespace IsaEken\Thinks\Tests;

use Illuminate\Support\Carbon;
use IsaEken\Thinks\Tests\Mock\Model;
use PHPUnit\Framework\TestCase;

class ModelTest extends TestCase
{
    public function test()
    {
        $model = new Model([
            'second_time' => '-1 years',
        ]);

        /** @var Carbon $second_time */
        $second_time = $model->getAttribute('second_time');
        $this->assertEquals($second_time->year, date('Y') - 1);

        $this->assertEquals(true, $model->getAttribute('testing'));
        $this->assertEquals('İsa', $model->getAttribute('my_name_is'));
        $this->assertEquals(Carbon::make('9/4/2021'), $model->getAttribute('time'));

        $model->setAttribute('time', Carbon::make('4/10/2021'));
        $this->assertNotEquals(Carbon::make('9/4/2021'), $model->getAttribute('time'));
        $this->assertEquals(Carbon::make('4/10/2021'), $model->getAttribute('time'));

        $model->removeAttribute('time');
        $this->assertFalse($model->hasAttribute('time'));

        $model->guard()->removeAttribute('my_name_is');
        $this->assertTrue($model->hasAttribute('my_name_is'));

        $this->assertEquals(true, $model->getTestingAttribute());
        $this->assertEquals(true, $model->getTesting());

        $model->setTesting(false);
        $this->assertEquals(false, $model->getTesting());

        $model->setTestingAttribute(true);
        $this->assertEquals(true, $model->getTestingAttribute());

        $this->assertEquals(true, $model->testing);
        $model->testing = false;
        $this->assertEquals(false, $model->testing);
    }
}
