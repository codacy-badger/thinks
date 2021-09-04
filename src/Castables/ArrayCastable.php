<?php

namespace IsaEken\Thinks\Castables;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use IsaEken\Thinks\Contracts\Objectable;

class ArrayCastable
{
    /**
     * @param mixed $value
     * @return mixed
     */
    public static function cast(mixed $value): mixed
    {
        if (is_array($value)) {
            return $value;
        }

        if ($value instanceof Arrayable) {
            return $value;
        }

        if ($value instanceof Objectable) {
            return (array) ($value->toObject());
        }

        if ($value instanceof Jsonable) {
            return json_decode($value->toJson());
        }

        if (is_string($value)) {
            $json = @json_decode($value, true);
            if (is_array($json)) {
                return $json;
            }

            return @unserialize($value) ?? [];
        }

        return $value;
    }
}
