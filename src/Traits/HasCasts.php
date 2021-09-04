<?php

namespace IsaEken\Thinks\Traits;

use Closure;
use Illuminate\Support\Carbon;
use IsaEken\Thinks\Castables\ArrayCastable;
use IsaEken\Thinks\Castables\BooleanCastable;
use JetBrains\PhpStorm\Pure;

trait HasCasts
{
    /**
     * @var array $casts
     */
    protected array $casts = [];

    /**
     * @var array $castables
     */
    protected array $castables = [
        'string' => 'strval',
        'str' => 'strval',

        'integer' => 'intval',
        'int' => 'intval',

        'float' => 'floatval',
        'double' => 'doubleval',

        'time' => Carbon::class,
        'date' => Carbon::class,
        'datetime' => Carbon::class,
        'carbon' => Carbon::class,

        'array' => [ArrayCastable::class, 'cast'],
        'bool' => [BooleanCastable::class, 'cast'],
        'boolean' => [BooleanCastable::class, 'cast'],
    ];

    /**
     * @inheritDoc
     */
    #[Pure] public function getCast(string $name, string $default = 'string'): string|array
    {
        if (array_key_exists($name, $this->casts) && array_key_exists($this->casts[$name], $this->castables)) {
            return $this->castables[$this->casts[$name]];
        }

        return $this->castables[$default];
    }

    /**
     * @inheritDoc
     */
    public function cast(string $name, mixed $value): mixed
    {
        if (is_callable($value)) {
            if ($value instanceof Closure) {
                $value = $value->bindTo(null, static::class);
            }

            $value = $value();
        }

        if (array_key_exists($name, $this->casts)) {
            $cast = $this->getCast($name);

            if (is_callable($cast)) {
                if (is_array($cast) && isset($cast[0]) && isset($cast[1])) {
                    $class = $cast[0];
                    $method = $cast[1];
                    return $class::$method($value);
                }

                return $cast($value);
            }

            if (is_string($cast)) {
                if (class_exists($cast)) {
                    return new $cast($value);
                }

                return $cast($value);
            }
        }

        return $value;
    }
}
