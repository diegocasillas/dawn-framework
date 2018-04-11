<?php 

namespace Dawn\Database;

class QueryBuilder
{
    protected $app;
    protected $connection;
    protected $model;
    protected $query;
    protected $statement;

    public function __construct($app = null, $connection = null, $model = null)
    {
        $this->app = $app;
        $this->connection = $connection;
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

    public function where($column, $operator, $value)
    {
        $this->query .= " WHERE " . $this->compare($column, $operator, $value);
        return $this;
    }

    public function and($column, $operator, $value)
    {
        $this->query .= " AND " . $this->compare($column, $operator, $value);
        return $this;
    }

    public function or($column, $operator, $value)
    {
        $this->query .= " OR " . $this->compare($column, $operator, $value);
        return $this;
    }

    public function compare($column, $operator, $value)
    {
        if (strtoupper($operator) === "LIKE") {
            $operator = " LIKE ";
        }

        if (is_string($value)) {
            return "$column$operator'$value'";
        }

        return "$column$operator$value";
    }

    public function insert($table, array $columns = [], array $values)
    {
        $this->query .= "INSERT INTO " . $table . $this->makeColumnsString($columns) . " VALUES(" . $this->makeValuesString($table, $columns, $values) . ")";
        return $this;
    }

    public function makeColumnsString($columns)
    {
        $columnsString = "";

        if (!empty($columns)) {
            $columnsString = "(" . implode(', ', $columns) . ")";
        }

        return $columnsString;
    }

    public function makeValuesString($table, $columns, $values)
    {
        $valuesString = "";

        foreach ($values as $index => $value) {
            if (is_string($value)) {
                $values[$index] = "'$value'";
            } else {
                $value .= "$value";
            }
        }

        $valuesString = implode(', ', $values);

        return $valuesString;
    }

    public function exec($query = null)
    {
        if ($query !== null) {
            $this->query = $query;
        }

        $this->statement = $this->connection->prepare($this->query);
        $this->clearQuery();

        return $this->statement->execute();
    }

    public function lastInsertId()
    {
        return $this->connection->lastInsertId();
    }

    public function clearQuery()
    {
        $this->query = null;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getStatement()
    {
        return $this->statement;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
