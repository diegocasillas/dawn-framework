<?php

namespace Dawn\Database;

use ReflectionClass;
use Dawn\App;
use Dawn\Database\QueryBuilder;

abstract class Model implements \JsonSerializable
{
    protected $queryBuilder;
    protected $table;
    protected $primaryKey;
    protected $id;
    protected $hidden = [];

    public function __construct()
    {
        $this->queryBuilder = app()->get('query builder');
        $this->queryBuilder->setModel(get_class($this));
        $this->table = strtolower((new ReflectionClass(get_class($this)))->getShortName()) . 's';
        $this->primaryKey = 'id';
        $this->hide(['queryBuilder', 'table', 'primaryKey']);
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

    public function aa()
    {
        $this->hidden = parent::hidden();
    }

    public function hide(array $properties)
    {
        foreach ($properties as $property) {
            array_push($this->hidden, $property);
        }

        return $this->hidden;
    }

    public function jsonSerialize()
    {
        $json = [];

        foreach ($this as $key => $value) {
            if (!in_array($key, $this->hidden) && $key !== 'hidden') {
                $json[$key] = $value;
            }
        }

        return $json;
    }
}
