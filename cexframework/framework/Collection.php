<?php

namespace Framework;

class Collection
{
    protected $items = [];

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function first(callable $callback = null)
    {
        if (!$callback) {
            return $this->items[0] ?? null;
        }

        for ($i = 0; $i < count($this->items); $i++) {
            $result = $callback($this->items[$i]);

            if ($result) {
                return $this->items[$i];
            }
        }

        return null;
    }

    public function keys()
    {
        return new static(
            array_keys($this->items)
        );
    }

    public function values()
    {
        return new static(
            array_values($this->items)
        );
    }

    public function implode($seperator)
    {
        return implode($seperator, $this->items);
    }

    public function each(callable $callback)
    {
        foreach ($this->items as $key => $value) {
            $result = $callback($key, $value);

            if ($result === false) {
                break;
            }
        }

        return $this;
    }

    public function map(callable $callback)
    {
        return new static(
            array_map($callback, $this->items)
        );
    }
}
