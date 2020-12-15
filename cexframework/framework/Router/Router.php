<?php

namespace Framework\Router;

use Framework\Exception\RouteNotRegistedException;
use Framework\Exception\RouteNotFoundException;
use Framework\Http\Request;
use Framework\Str;

class Router
{
    protected $routeMap = [
        'get' => [],
        'post' => []
    ];

    public function addRoute($method, $url, $action)
    {
        $this->routeMap[$method][] = [
            'url' => $url,
            'action' => $action
        ];
    }

    public function dispatch()
    {
        $request = resolve(Request::class);

        if (!$matched = $this->getRegistedRoute($request)) {
            throw new RouteNotRegistedException;
        }

        [$controller, $action] = $this->getCallableController($matched);

        if ($request->hasSegment($matched)) {
            return (new $controller())->$action(
                ...$request->segment($matched)
            );
        } else {
            return (new $controller())->$action();
        }
    }

    public function getRegistedRoute(Request $request)
    {
        if (empty($routes = $this->routeMap[$request->method()])) {
            return false;
        }

        $uri = $request->uri();

        $matched = collect($routes)->first(function ($route) use ($uri) {
            if (Str::contains($route['url'], '/:')) {

                $explodeMatchedRoute = explode('/', Str::replaceFirst('/', '', $route['url']));
                $explodeMatchedURL = explode('/', Str::replaceFirst('/', '', $uri));

                return count($explodeMatchedRoute) === count($explodeMatchedURL);
            }
            return $uri === $route['url'];
        });       

        if (!$matched) {
            throw new RouteNotFoundException;
        }

        return $matched;
    }

    protected function getCallableController(array $matched)
    {
        return explode('@', $matched['action']);
    }
}
