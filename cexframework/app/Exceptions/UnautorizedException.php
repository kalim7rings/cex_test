<?php

namespace App\Exceptions;

use Framework\Exception\Exception;

class UnautorizedException extends Exception
{
    public $errorMessage = '';
    public function __construct($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    public function render()
    {
        http_response_code(401);

        header('Content-Type: application/json');

        echo json_encode([
            'message' => $this->errorMessage
        ]);
    }
}
