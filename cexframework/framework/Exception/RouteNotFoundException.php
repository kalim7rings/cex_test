<?php

namespace Framework\Exception;

class RouteNotFoundException extends Exception
{
    public function render()
    {
        http_response_code(404);

        header('Content-Type: application/json');

        echo json_encode([
            'message' => 'The route is not registed'
        ]);
    }
}
