<?php

namespace Framework\Router;

class Route
{
    protected $router;

    protected static $instance = null;

    private function __construct(Router $router)
    {
        $this->router = $router;
    }

    public static function get($url, $action)
    {
        static::getInstance()
            ->addRoute('get', $url, $action);
    }

    public static function post($url, $action)
    {
        static::getInstance()
            ->addRoute('post', $url, $action);
    }

    public static function getInstance()
    {
        if (isset(static::$instance)) {
            return static::$instance;
        }

        return static::$instance = (new static(new Router));
    }

    protected function addRoute($method, $url, $action)
    {
        $this->router->addRoute($method, $url, $action);
    }

    public static function dispatch()
    {
        return static::getInstance()->router->dispatch();
    }
}
