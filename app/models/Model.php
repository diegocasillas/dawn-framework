<?php

abstract class Model
{
    protected $db;
    protected $table;
    protected $id;

    public function __construct()
    {
        global $db;
        $this->db = $db;
        $this->table = strtolower(get_class($this)) . 's';
    }

    public function getId()
    {
        return $this->id;
    }

    public static function all()
    {
        $instance = new static;

        $sql = "SELECT * FROM {$instance->table}";
        $statement = $instance->db->prepare($sql);
        $statement->bindParam(':table', $instance->table);

        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_CLASS, get_class($instance));

        return $result;
    }

    public static function find($id)
    {
        $instance = new static;

        $sql = "SELECT * FROM {$instance->table} WHERE id={$id}";
        $statement = $instance->db->prepare($sql);
        $statement->bindParam(':table', $instance->table);

        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_CLASS, get_class($instance));

        return $result;
    }

    public function getBy($column, $id)
    {
        $instance = new static;

        $sql = "SELECT * FROM {$instance->table} WHERE {$column}='{$id}'";
        $statement = $instance->db->prepare($sql);
        $statement->bindParam(':table', $instance->table);

        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_CLASS, get_class($instance));


        return $result;
    }


    //  ################################## Inheritance
    //  public function save()
    // {
    //     $sql = "
    //         INSERT INTO {$this->table}(author, title, body)
    //         VALUES('{$this->author}', '{$this->title}', '{$this->body}')
    //     ";
    //     $this->db->exec($sql);

    //     $this->id = $this->db->lastInsertId();
    // }
}
