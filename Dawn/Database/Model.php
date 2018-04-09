<?php

namespace Dawn\Database;

use ReflectionClass;
use PDO;
use Dawn\Database\Connection;
use Dawn\App;

abstract class Model
{
    protected $connection;
    protected $table;
    protected $id;

    public function __construct()
    {
        $this->connection = connection();
        $this->table = strtolower((new ReflectionClass(get_class($this)))->getShortName()) . 's';
    }

    public function id()
    {
        return $this->id;
    }

    public function all()
    {
        $sql = "SELECT * FROM {$this->table}";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':table', $this->table);

        $statement->execute();

        $result = $statement->fetchAll($this->connection::FETCH_CLASS, get_class($this));

        return $result;
    }

    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id='{$id}'";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':table', $this->table);

        $statement->execute();

        $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this));

        $result = $statement->fetch();

        return $result;
    }

    public function getBy($key, $value)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$key}='{$value}'";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':table', $this->table);

        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_CLASS, get_class($this));


        return $result;
    }

    public function getColumnBy($column, $key, $value)
    {
        $sql = "SELECT {$column} FROM {$this->table} WHERE {$key}='{$value}'";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':table', $this->table);

        $statement->execute();

        return $statement->fetch()[$column];
    }

    public function getId()
    {
        return (int)$this->id;
    }
}
