<?php

namespace Framework\ORM;

use JsonSerializable;

class Model implements JsonSerializable
{
    protected array $attributes = [];

    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    public function newQuery()
    {
        return new QueryBuilder($this);
    }

    public function __call($method, $parameters)
    {
        return $this->newQuery()->{$method}(...$parameters);
    }

    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }

    public function jsonSerialize()
    {
        return $this->attributes;
    }

    public function __get($name)
    {
        return $this->attributes[$name] ?? null;
    }
}
