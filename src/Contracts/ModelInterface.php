<?php

namespace IsaEken\Thinks\Contracts;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

interface ModelInterface extends Arrayable, Objectable, Jsonable, HasAttributes, HasCasts
{
    // ...
}
