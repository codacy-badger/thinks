<?php

namespace IsaEken\Thinks\Tests\Mock;

use IsaEken\Thinks\Contracts\HasCasts as HasCastsInterface;
use IsaEken\Thinks\Traits\HasCasts;

class Cast implements HasCastsInterface
{
    use HasCasts;

    public function getCasts()
    {
        return $this->casts;
    }

    public function getCastables()
    {
        return $this->castables;
    }

    public function setCasts(array $casts)
    {
        $this->casts = array_merge($this->casts, $casts);
    }

    public function setCastables(array $castables)
    {
        $this->castables = array_merge($this->castables, $castables);
    }

//    protected array $casts = [
//        'my_name_is' => 'string',
//        'testing' => 'bool',
//        'age' => 'integer',
//        'float' => 'float',
//        'double' => 'double',
//        'birth_date' => 'datetime',
//        'list' => 'array',
//    ];
}
