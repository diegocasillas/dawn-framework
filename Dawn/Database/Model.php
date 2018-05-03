<?php

namespace Dawn\Database;

use ReflectionClass;
use Dawn\App;

/**
 * Class to be extended by application models.
 */
abstract class Model implements \JsonSerializable
{
    /**
     * Instance of query builder.
     *
     * @var Dawn\Database\QueryBuilder
     */
    protected $queryBuilder;

    /**
     * Name of the model table.
     *
     * @var string
     */
    protected $table;

    /**
     * Name of the primary key column.
     *
     * @var string
     */
    protected $primaryKey;

    /**
     * ID of the model instance.
     *
     * @var mixed
     */
    protected $id;

    /**
     * Array that contains the visible properties of the model.
     *
     * @var array
     */
    protected $visible = [];

    /**
     * Array that contains the hidden properties of the model.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Create a new Model instance.
     */
    public function __construct()
    {
        $this->queryBuilder = app()->get('query builder');
        $this->queryBuilder->setModel(get_class($this));
        $this->table = strtolower((new ReflectionClass(get_class($this)))->getShortName()) . 's';
        $this->primaryKey = 'id';
        $this->hidden(['queryBuilder', 'table', 'primaryKey', 'visible', 'hidden']);
    }

    /**
     * Get the id of the instance.
     *
     * @return mixed
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * Get all rows from the table.
     *
     * @return array
     */
    public function all()
    {
        return $this->queryBuilder->select()->from($this->table)->get();
    }

    /**
     * Get a row by primary key.
     *
     * @param mixed $primaryKey
     * @return object
     */
    public function find($primaryKey)
    {
        return $this->queryBuilder->select()->from($this->table)->where($this->primaryKey, '=', $primaryKey)->get();
    }

    /**
     * Get rows by key and value.
     *
     * @param string $key
     * @param mixed $value
     * @return array
     */
    public function getBy(string $key, $value)
    {
        return $this->queryBuilder->select()->from($this->table)->where($key, '=', $value)->get();
    }

    /**
     * Get rows of a column by key and value.
     *
     * @param string $column
     * @param string $key
     * @param mixed $value
     * @return array
     */
    public function getColumnBy($column, $key, $value)
    {
        return $this->queryBuilder->select($column)->from($this->table)->where($key, '=', $value)->get('column');
    }

    /**
     * Get the ID of the instance.
     *
     * @return int
     */
    public function getId()
    {
        return (int)$this->id;
    }

    /**
     * Make properties from array visible.
     *
     * @param array $properties
     * @return array
     */
    protected function visible(array $properties = [])
    {
        foreach ($this as $key => $value) {
            if (in_array($key, $properties) || !in_array($key, $this->hidden)) {
                $this->visible[$key] = $value;
            }
        }

        return $this->visible;
    }

    /**
     * Make properties from array hidden.
     *
     * @param array $properties
     * @return array
     */
    protected function hidden(array $properties = [])
    {
        foreach ($properties as $property) {
            if (!in_array($property, $this->hidden)) {
                array_push($this->hidden, $property);
            }
        }

        return $this->hidden;
    }

    /**
     * Get the visible properties from the items.
     *
     * @param array $items
     * @return array
     */
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

    /**
     * Implementation of the JsonSerialize interface.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->visible;
    }
}
