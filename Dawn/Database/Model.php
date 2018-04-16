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
    protected $visible = [];
    protected $hidden = [];

    public function __construct()
    {
        $this->queryBuilder = app()->get('query builder');
        $this->queryBuilder->setModel(get_class($this));
        $this->table = strtolower((new ReflectionClass(get_class($this)))->getShortName()) . 's';
        $this->primaryKey = 'id';
        $this->hidden(['queryBuilder', 'table', 'primaryKey', 'visible', 'hidden']);
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

    protected function visible(array $properties = [])
    {
        foreach ($this as $key => $value) {
            if (in_array($key, $properties) || !in_array($key, $this->hidden)) {
                $this->visible[$key] = $value;
            }
        }

        return $this->visible;
    }

    protected function hidden(array $properties = [])
    {
        foreach ($properties as $property) {
            if (!in_array($property, $this->hidden)) {
                array_push($this->hidden, $property);
            }
        }

        return $this->hidden;
    }

    public function hide(array $items = null)
    {
        if ($items !== null) {
            $hide = array_map(function ($item) {
                return $item->visible();
            }, $items);
        } else {
            $hide = $this->visible();
        }

        return $hide;
    }

    public function jsonSerialize()
    {
        return $this->visible();
    }
}
