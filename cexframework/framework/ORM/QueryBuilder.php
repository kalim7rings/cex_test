<?php

namespace Framework\ORM;

use PDO;
use PDOException;

class QueryBuilder
{
    protected $model = null;

    protected $connection = null;

    protected $wheres = [];

    public function __construct($model)
    {
        $this->model = $model;

        $this->connection = resolve(Connection::class)->getConnection();
    }

    public function create(array $attributes = [])
    {
        $columns = collect($attributes)
            ->keys()
            ->implode(', ');

        $values = collect($attributes)
            ->values()
            ->map(function ($value) {
                return "'$value'";
            })
            ->implode(', ');

        $sql = "INSERT INTO {$this->model->table} ({$columns}) VALUES ($values)";

        try {
            $this->connection->exec($sql);

            return new $this->model($attributes);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function find(int $id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM {$this->model->table} where {$this->model->primaryKey} = {$id} limit 1");

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $stmt->execute();

        $result = $stmt->fetch();

        if (!$result) {
            return null;
        }

        return new $this->model($result);
    }

    public function first()
    {
        $condition = '';

        foreach ($this->wheres as $key => $where) {
            if ($key === 0) {
                $condition .= "where {$where[0]} $where[1] '$where[2]'";
            } else {
                $condition .= " and {$where[0]} $where[1] '$where[2]'";
            }
        }

        $sql = "SELECT * FROM {$this->model->table} $condition limit 1";

        $stmt = $this->connection->prepare($sql);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $stmt->execute();

        $result = $stmt->fetch();

        if (!$result) {
            return null;
        }

        return new $this->model($result);
    }

    public function where($key, $condition = null, $value = null)
    {
        if (func_num_args() === 2) {
            $value = $condition;
            $condition = '=';
        }

        $this->wheres[] = [
            $key,
            $condition,
            $value
        ];

        return $this;
    }
}
