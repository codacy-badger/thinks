<?php

namespace IsaEken\Thinks\Castables;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use IsaEken\Thinks\Contracts\Objectable;

class BooleanCastable
{
    /**
     * @param mixed $value
     * @return mixed
     */
    public static function cast(mixed $value): mixed
    {
        $positives = [
            'true',
            'yes',
            'positive',
            '1',
        ];

        $negatives = [
            'false',
            'no',
            'negative',
            '0',
        ];

        $value = mb_strtolower(trim($value));

        if (in_array($value, $positives, true)) {
            return true;
        }

        if (in_array($value, $negatives, true)) {
            return false;
        }

        return boolval($value);
    }
}
