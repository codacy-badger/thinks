<?php

namespace IsaEken\Thinks\Traits;

use IsaEken\Thinks\Contracts\HasCasts as HasCastsInterface;

trait HasAttributes
{
    /**
     * @var array $attributes
     */
    protected array $attributes = [];

    /**
     * @var bool $guarded
     */
    protected bool $guarded = false;

    /**
     * @inheritDoc
     */
    public function fill(array $attributes): static
    {
        if (!$this->isGuarded()) {
            $this->attributes = array_merge($this->attributes, $attributes);
            return $this;
        }

        foreach ($attributes as $key => $value) {
            $this->setAttribute($key, $value);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function hasAttribute(string $name): bool
    {
        return array_key_exists($name, $this->attributes);
    }

    /**
     * @inheritDoc
     */
    public function getAttribute(string $name, mixed $default = null): mixed
    {
        if ($this->hasAttribute($name)) {
            if ($this instanceof HasCastsInterface) {
                return $this->cast($name, $this->attributes[$name]);
            }

            return $this->attributes[$name];
        }

        return $default;
    }

    /**
     * @inheritDoc
     */
    public function setAttribute(string $name, mixed $value): static
    {
        if ($this->isGuarded() && !$this->hasAttribute($name)) {
            return $this;
        }

        $this->attributes[$name] = $value;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function removeAttribute(string $name): static
    {
        if ($this->hasAttribute($name) && !$this->isGuarded()) {
            unset($this->attributes[$name]);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function guard(): static
    {
        $this->guarded = true;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function unguard(): static
    {
        $this->guarded = false;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isGuarded(): bool
    {
        return $this->guarded;
    }

    /**
     * @inheritDoc
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }
}
