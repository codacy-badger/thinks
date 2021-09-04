<?php

namespace IsaEken\Thinks\Tests\Mock;


use IsaEken\Thinks\Model as BaseModel;

class Model extends BaseModel
{
    protected array $casts = [
        'testing' => 'bool',
        'time' => 'datetime',
        'second_time' => 'datetime',
    ];

    protected array $attributes = [
        'testing' => true,
        'my_name_is' => 'İsa',
        'time' => '9/4/2021',
    ];
}
