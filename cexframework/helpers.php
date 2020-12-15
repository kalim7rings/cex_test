<?php

use Framework\Collection;
use Framework\Container;

if (! function_exists('base_path')) {
    function base_path($append)
    {
        return __DIR__."/$append";
    }
}

if (! function_exists('resolve')) {
    function resolve($class)
    {
        return Container::resolve($class);
    }
}

if (! function_exists('collect')) {
    function collect($class)
    {
        return new Collection($class);
    }
}

if (! function_exists('dd')) {
    function dd()
    {
        foreach (func_get_args() as $args) {
           var_dump($args);
        }

        die();
    }
}
