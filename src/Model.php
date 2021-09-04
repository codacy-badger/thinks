<?php

namespace IsaEken\Thinks;

use Illuminate\Support\Str;
use IsaEken\Thinks\Contracts\ModelInterface;
use IsaEken\Thinks\Traits\HasAttributes;
use IsaEken\Thinks\Traits\HasCasts;
use JetBrains\PhpStorm\Pure;

abstract class Model implements ModelInterface
{
    use HasAttributes;
    use HasCasts;

    /**
     * @param array|null $attributes
     */
    public function __construct(array|null $attributes = null)
    {
        if ($attributes !== null) {
            $this->fill($attributes);
        }
    }

    /**
     * @inheritDoc
     */
    #[Pure] public function toArray(): array
    {
        return $this->getAttributes();
    }

    /**
     * @inheritDoc
     */
    public function toJson($options = 0): bool|string
    {
        return json_encode($this->toObject(), $options);
    }

    /**
     * @inheritDoc
     */
    #[Pure] public function toObject(): object
    {
        return (object) $this->toArray();
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        if ($this->hasAttribute($name)) {
            return $this->getAttribute($name);
        }

        return $this->$name;
    }

    /**
     * @param string $name
     * @param        $value
     */
    public function __set(string $name, $value): void
    {
        $this->setAttribute($name, $value);
    }

    /**
     * @param string $name
     * @param array  $arguments
     * @return Model|mixed
     */
    public function __call(string $name, array $arguments)
    {
        $tempName = strtolower(trim($name));

        if (Str::startsWith($tempName, ['get', 'set'])) {
            if (str_ends_with($name, 'Attribute')) {
                $name = Str::of($name)->beforeLast('Attribute')->__toString();
            }

            if (str_starts_with($tempName, 'get')) {
                $name = Str::of($name)->substr(strlen('get'))->snake();
                return $this->getAttribute($name, ...$arguments);
            }

            if (str_starts_with($tempName, 'set')) {
                $name = Str::of($name)->substr(strlen('set'))->camel();
                return $this->setAttribute($name, ...$arguments);
            }
        }

        return $this->$name(...$arguments);
    }
}
