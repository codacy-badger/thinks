<?php

namespace IsaEken\Thinks\Contracts;

interface Objectable
{
    /**
     * Convert to object
     *
     * @return object
     */
    public function toObject(): object;
}
