<?php

namespace IsaEken\Thinks\Contracts;

interface HasAttributes
{
    /**
     * Fill attributes with an array.
     *
     * @param array $attributes
     * @return $this
     */
    public function fill(array $attributes): static;

    /**
     * Check if attribute exists.
     *
     * @param string $name
     * @return bool
     */
    public function hasAttribute(string $name): bool;

    /**
     * Get attribute if exists.
     * If the attribute does not exist, it returns the defined default value or null.
     * If casting is active when the attribute is found, casting is performed.
     *
     * @param string     $name
     * @param mixed|null $default
     * @return mixed
     */
    public function getAttribute(string $name, mixed $default = null): mixed;

    /**
     * Set the attribute.
     *
     * @param string $name
     * @param mixed  $value
     * @return $this
     */
    public function setAttribute(string $name, mixed $value): static;

    /**
     * Remove attribute if its exists.
     *
     * @param string $name
     * @return $this
     */
    public function removeAttribute(string $name): static;

    /**
     * Guard the attributes.
     * @return $this
     */
    public function guard(): static;

    /**
     * Unguard the attributes.
     *
     * @return $this
     */
    public function unguard(): static;

    /**
     * Check if this model guarded.
     *
     * @return bool
     */
    public function isGuarded(): bool;

    /**
     * Get all defined attributes.
     *
     * @return array
     */
    public function getAttributes(): array;
}
