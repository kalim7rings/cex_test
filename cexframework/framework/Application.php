<?php

namespace Framework;

use Framework\Router\Route;

class Application
{
    public function run()
    {
        $this->registerRoutes();

        $this->loadCors();

        return $this->displachRoutes();
    }

    protected function registerRoutes()
    {
        require_once base_path('routes/web.php');
    }

    protected function displachRoutes()
    {
        return Route::dispatch();
    }

    protected function loadCors()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Expose-Headers: Content-Length, X-JSON");
        header("Content-Type: application/json");
        header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: *");
    }
}
