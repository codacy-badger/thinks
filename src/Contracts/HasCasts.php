<?php

namespace IsaEken\Thinks\Contracts;

interface HasCasts
{
    /**
     * Get cast.
     *
     * @param string $name
     * @param string $default
     * @return string|array
     */
    public function getCast(string $name, string $default = 'string'): string|array;

    /**
     * Get casted value.
     *
     * @param string $name
     * @param mixed  $value
     * @return mixed
     */
    public function cast(string $name, mixed $value): mixed;
}
