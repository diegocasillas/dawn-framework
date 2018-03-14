<?php

namespace Dawn\Database;

use ReflectionClass;
use PDO;
use Dawn\Database\Connection;

abstract class Model
{
    protected $connection;
    protected $table;
    protected $id;

    public function __construct()
    {
        $this->connection = Connection::make(CONFIG['database']);
        $this->table = strtolower((new ReflectionClass(get_class($this)))->getShortName()) . 's';
    }

    public function id()
    {
        return $this->id;
    }

    public static function all()
    {
        $instance = new static;

        $sql = "SELECT * FROM {$instance->table}";
        $statement = $instance->connection->prepare($sql);
        $statement->bindParam(':table', $instance->table);

        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_CLASS, get_class($instance));

        return $result;
    }

    public static function find($id)
    {
        $instance = new static;
        $sql = "SELECT * FROM {$instance->table} WHERE id='{$id}'";
        $statement = $instance->connection->prepare($sql);
        $statement->bindParam(':table', $instance->table);

        $statement->execute();

        $statement->setFetchMode(PDO::FETCH_CLASS, get_class($instance));

        $result = $statement->fetch();

        return $result;
    }

    public static function getBy($key, $value)
    {
        $instance = new static;

        $sql = "SELECT * FROM {$instance->table} WHERE {$key}='{$value}'";
        $statement = $instance->connection->prepare($sql);
        $statement->bindParam(':table', $instance->table);

        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_CLASS, get_class($instance));


        return $result;
    }

    public static function getColumnBy($column, $key, $value)
    {
        $instance = new static;

        $sql = "SELECT {$column} FROM {$instance->table} WHERE {$key}='{$value}'";

        $statement = $instance->connection->prepare($sql);
        $statement->bindParam(':table', $instance->table);

        $statement->execute();

        return $statement->fetch()[$column];
    }

    public function getId()
    {
        return (int)$this->id;
    }

    //  ################################## Inheritance
    //  public function save()
    // {
    //     $sql = "
    //         INSERT INTO {$this->table}(author, title, body)
    //         VALUES('{$this->author}', '{$this->title}', '{$this->body}')
    //     ";
    //     $this->connection->exec($sql);

    //     $this->id = $this->connection->lastInsertId();
    // }
}
