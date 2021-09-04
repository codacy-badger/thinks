<?php

namespace IsaEken\Thinks\Traits;

use BadMethodCallException;
use Closure;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

trait Macroable
{
    /**
     * @var array $macros
     */
    protected static array $macros = [];

    /**
     * @param string          $name
     * @param object|callable $macro
     */
    public static function macro(string $name, object|callable $macro): void
    {
        static::$macros[$name] = $macro;
    }

    /**
     * @param object $mixin
     * @param bool   $replace
     * @throws ReflectionException
     */
    public static function mixin(object $mixin, bool $replace = true): void
    {
        $methods = (new ReflectionClass($mixin))->getMethods(
            ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_PROTECTED
        );

        foreach ($methods as $method) {
            if ($replace || !static::hasMacro($method->name)) {
                $method->setAccessible(true);
                static::macro($method->name, $method->invoke($mixin));
            }
        }
    }

    /**
     * @param string $name
     * @return bool
     */
    public static function hasMacro(string $name): bool
    {
        return array_key_exists($name, static::$macros);
    }

    /**
     * @param string $name
     * @param array  $arguments
     * @return mixed
     */
    public static function __callStatic(string $name, array $arguments)
    {
        if (!static::hasMacro($name)) {
            throw new BadMethodCallException(sprintf(
                'Method %s::%s does not exists.', static::class, $name
            ));
        }

        $macro = static::$macros[$name];

        if ($macro instanceof Closure) {
            $macro = $macro->bindTo(null, static::class);
        }

        return $macro(...$arguments);
    }

    /**
     * @param string $name
     * @param array  $arguments
     * @return mixed
     */
    public function __call(string $name, array $arguments)
    {
        return static::__callStatic($name, ...$arguments);
    }
}
