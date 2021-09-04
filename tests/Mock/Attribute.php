<?php

namespace IsaEken\Thinks\Tests\Mock;

use IsaEken\Thinks\Contracts\HasAttributes as HasAttributesInterface;
use IsaEken\Thinks\Traits\HasAttributes;

class Attribute implements HasAttributesInterface
{
    use HasAttributes;
}
