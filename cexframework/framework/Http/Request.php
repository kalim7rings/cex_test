<?php

namespace Framework\Http;

use Framework\Str;

class Request
{
    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function uri()
    {
        return strtolower($_SERVER['REQUEST_URI']);
    }

    public function hasSegment($currentRoute)
    {
        return Str::contains($currentRoute['url'], '/:');
    }

    public function segment($currentRoute)
    {
        $explodeMatchedRoute = explode('/', Str::replaceFirst('/', '', $currentRoute['url']));

        $explodeMatchedURL = explode('/', Str::replaceFirst('/', '', $this->uri()));

        $segments = [];

        foreach ($explodeMatchedRoute as $index => $parts) {
            if (Str::contains($parts, ':')) {
                array_push($segments, $explodeMatchedURL[$index]);
            }
        }

        return $segments;
    }

    public function all()
    {
        return json_decode(file_get_contents("php://input"), TRUE);
    }
}
