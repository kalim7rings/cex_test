<?php

namespace Framework\ORM;

use PDO;

class Connection
{
    protected $connection = null;

    public function __construct()
    {      
      $this->connection = new PDO('mysql:host=localhost;dbname=cex', 'root', '');
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
