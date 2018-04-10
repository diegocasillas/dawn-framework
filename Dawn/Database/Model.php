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
        $this->table = strtolower((new ReflectionClass(get_class($this)))->getShortName()) . 's';
    }

    public function id()
    {
        return $this->id;
    }

    public function all()
    {
        $this->queryBuilder->select()->from([$this->table])->exec();
        $statement = $this->queryBuilder->getStatement();
        $result = $statement->fetchAll(PDO::FETCH_CLASS, get_class($this));

        return $result;
    }

    public function find($id)
    {
        $this->queryBuilder->select()->from([$this->table])->where('id', '=', $id)->exec();

        $statement = $this->queryBuilder->getStatement();
        $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this));
        $result = $statement->fetch();

        return $result;
    }

    public function getBy($key, $value)
    {
        $this->queryBuilder->select()->from([$this->table])->where($key, '=', $value)->exec();
        $statement = $this->queryBuilder->getStatement();
        $result = $statement->fetchAll(PDO::FETCH_CLASS, get_class($this));

        return $result;
    }

    public function getColumnBy($column, $key, $value, $number = false)
    {
        if (!$number) {
            $this->queryBuilder->select()->from([$this->table])->where($key, '=', $value)->exec();
        } else {
            $this->queryBuilder->select()->from([$this->table])->where($key, '=', $value, true)->exec();
        }

        return $this->queryBuilder->getStatement()->fetch()[$column];
    }

    public function getId()
    {
        return (int)$this->id;
    }
}
