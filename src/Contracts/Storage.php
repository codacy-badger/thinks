<?php

namespace IsaEken\Thinks\Contracts;

interface Storage
{
    /**
     * Get all item keys.
     *
     * @return array
     */
    public function getKeys(): array;

    /**
     * Get all item values.
     *
     * @return array
     */
    public function getValues(): array;

    /**
     * Check item has exists.
     *
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * Get item.
     *
     * @param string     $key
     * @param mixed|null $default
     * @return mixed
     */
    public function get(string $key, mixed $default = null): mixed;

    /**
     * Create or set item.
     *
     * @param string $key
     * @param mixed  $value
     * @return $this
     */
    public function set(string $key, mixed $value): static;

    /**
     * Remove item.
     *
     * @param string $key
     * @return $this
     */
    public function remove(string $key): static;
}
