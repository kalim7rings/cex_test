<?php

namespace Framework;

class Container
{
    protected static $bindings = [];

    public static function resolve(string $class)
    {
        if (isset(static::$bindings[$class])) {
            return static::$bindings[$class];
        }

        return static::$bindings[$class] = new $class;
    }
}
