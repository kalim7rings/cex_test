<?php

namespace App\Exceptions;

use Framework\Exception\Exception;

class UserExistsException extends Exception
{
    public function render()
    {
        http_response_code(422);

        header('Content-Type: application/json');

        echo json_encode([
            'message' => 'User already exits.'
        ]);
    }
}
