<?php

namespace IsaEken\Thinks;

use IsaEken\Thinks\Contracts\Storage;
use JetBrains\PhpStorm\Pure;

class MemoryStorage implements Storage
{
    /**
     * @var array $storage
     */
    public array $storage = [];

    /**
     * @param array $storage
     */
    public function __construct(array $storage = [])
    {
        $this->storage = $storage;
    }

    /**
     * @inheritDoc
     */
    public function getKeys(): array
    {
        return array_keys($this->storage);
    }

    /**
     * @inheritDoc
     */
    public function getValues(): array
    {
        return array_values($this->storage);
    }

    /**
     * @inheritDoc
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->storage);
    }

    /**
     * @inheritDoc
     */
    #[Pure] public function get(string $key, mixed $default = null): mixed
    {
        if ($this->has($key)) {
            return $this->storage[$key];
        }

        return $default;
    }

    /**
     * @inheritDoc
     */
    public function set(string $key, mixed $value): static
    {
        $this->storage[$key] = $value;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function remove(string $key): static
    {
        if ($this->has($key)) {
            unset($this->storage[$key]);
        }

        return $this;
    }
}
