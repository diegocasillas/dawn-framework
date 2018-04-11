<?php

namespace Dawn\Database;

use ReflectionClass;
use PDO;
use Dawn\Database\QueryBuilder;
use Dawn\App;

abstract class Model
{
    protected $queryBuilder;
    protected $table;
    protected $id;

    public function __construct()
    {
        $this->queryBuilder = app()->get('query builder');
        $this->queryBuilder->setModel(get_class($this));
        $this->table = strtolower((new ReflectionClass(get_class($this)))->getShortName()) . 's';
    }

    public function id()
    {
        return $this->id;
    }

    public function all()
    {
        $this->queryBuilder->select()->from($this->table)->exec();

        return $this->queryBuilder->fetch();
    }

    public function find($id)
    {
        $this->queryBuilder->select()->from($this->table)->where('id', '=', $id)->exec();

        return $this->queryBuilder->fetch();
    }

    public function getBy($key, $value)
    {
        $this->queryBuilder->select()->from($this->table)->where($key, '=', $value)->exec();
        $statement = $this->queryBuilder->getPreparedStatement();
        $result = $statement->fetchAll(PDO::FETCH_CLASS, get_class($this));

        return $result;
    }

    public function getColumnBy($column, $key, $value, $number = false)
    {
        if (!$number) {
            $this->queryBuilder->select()->from($this->table)->where($key, '=', $value)->exec();
        } else {
            $this->queryBuilder->select()->from($this->table)->where($key, '=', $value, true)->exec();
        }

        return $this->queryBuilder->getPreparedStatement()->fetch()[$column];
    }

    public function getId()
    {
        return (int)$this->id;
    }
}
