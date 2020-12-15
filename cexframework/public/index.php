<?php

use Framework\Exception\Exception;
use Framework\Http\Response;

require __DIR__ . '/../vendor/autoload.php';

try {
    $app = new Framework\Application();

    $response = $app->run();

    (new Response($response))
        ->send();
} catch (Exception $e) {
    if (method_exists($e, 'render')) {
        return $e->render();
    } else {
        throw $e;
    }
}
