<?php

namespace Dawn\Database;

use ReflectionClass;
use Dawn\App;
use Dawn\Database\QueryBuilder;

abstract class Model
{
    protected $queryBuilder;
    protected $table;
    protected $primaryKey;
    protected $id;

    public function __construct()
    {
        $this->queryBuilder = app()->get('query builder');
        $this->queryBuilder->setModel(get_class($this));
        $this->table = strtolower((new ReflectionClass(get_class($this)))->getShortName()) . 's';
        $this->primaryKey = 'id';
    }

    public function id()
    {
        return $this->id;
    }

    public function all()
    {
        return $this->queryBuilder->select()->from($this->table)->get();
    }

    public function find($primaryKey)
    {
        return $this->queryBuilder->select()->from($this->table)->where($this->primaryKey, '=', $primaryKey)->get();
    }

    public function getBy($key, $value)
    {
        return $this->queryBuilder->select()->from($this->table)->where($key, '=', $value)->get();
    }

    public function getColumnBy($column, $key, $value)
    {
        return $this->queryBuilder->select($column)->from($this->table)->where($key, '=', $value)->get('column');
    }

    public function getId()
    {
        return (int)$this->id;
    }
}
