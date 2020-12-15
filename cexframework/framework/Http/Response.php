<?php

namespace Framework\Http;

class Response
{
    protected $payload = null;

    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    public function send()
    {
        http_response_code(200);

        header('Content-Type: application/json');

        echo json_encode($this->payload);
    }
}
