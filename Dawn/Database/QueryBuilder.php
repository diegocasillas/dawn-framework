<?php 

namespace Dawn\Database;

class QueryBuilder
{
    protected $query;
    protected $model;

    public function __construct($model = null)
    {
        $this->model = $model;
    }

    public function select(array $columns = ['*'])
    {
        $this->query .= "SELECT " . implode(', ', $columns);
        return $this;
    }

    public function from(array $columns = ['*'])
    {
        $this->query .= " FROM " . implode(', ', $columns);
        return $this;
    }

    public function where($column, $operator, $value, $number = false)
    {
        $this->query .= " WHERE " . $this->compare($column, $operator, $value, $number);
        return $this;
    }

    public function and($column, $operator, $value, $number = false)
    {
        $this->query .= " AND " . $this->compare($column, $operator, $value, $number);
        return $this;
    }

    public function or($column, $operator, $value, $number = false)
    {
        $this->query .= " OR " . $this->compare($column, $operator, $value, $number);
        return $this;
    }

    public function compare($column, $operator, $value, $number = false)
    {
        if (strtoupper($operator) === "LIKE") {
            $operator = " LIKE ";
        }

        if ($number === false) {
            return "$column$operator'$value'";
        }

        return "$column$operator$value";
    }

    public function getQuery()
    {
        return $this->query;
    }
}
