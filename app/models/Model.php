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

    public static function all()
    {
        $instance = new static;

        $sql = "SELECT * FROM {$instance->table}";
        $statement = $instance->db->prepare($sql);
        $statement->bindParam(':table', $instance->table);

        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_CLASS);

        return $result;
    }

    public static function find($id)
    {
        $instance = new static;

        $sql = "SELECT * FROM {$instance->table} WHERE id={$id}";
        $statement = $instance->db->prepare($sql);
        $statement->bindParam(':table', $instance->table);

        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_CLASS);

        return $result;
    }
}
