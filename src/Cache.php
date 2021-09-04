<?php

namespace IsaEken\Thinks;

class Cache extends MemoryStorage
{
    /**
     * @param string $key
     * @param mixed  $value
     * @param bool   $fresh
     * @return mixed
     */
    public function remember(string $key, mixed $value, bool $fresh = false): mixed
    {
        if ($this->has($key) && $fresh === false) {
            return $this->get($key);
        }

        if (is_callable($value)) {
            $value = $value();
        }

        $this->set($key, $value);
        return $value;
    }

    /**
     * @return $this
     */
    public function invalidate(): static
    {
        $this->storage = [];
        return $this;
    }
}
