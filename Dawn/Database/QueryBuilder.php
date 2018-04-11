<?php 

namespace Dawn\Database;

class QueryBuilder
{
    protected $app;
    protected $connection;
    protected $model;
    protected $query;
    protected $preparedStatement;

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
        $this->query .= $this->compare('WHERE', $column, $operator, $value);
        return $this;
    }

    public function and($column, $operator, $value)
    {
        $this->query .= $this->compare('AND', $column, $operator, $value);
        return $this;
    }

    public function or($column, $operator, $value)
    {
        $this->query .= $this->compare('OR', $column, $operator, $value);
        return $this;
    }

    public function compare($word, $column, $operator, $value)
    {
        $operator = strtolower($operator);

        if ($operator === 'is' || $operator === "like" || $operator === "in" || $operator === "between") {
            $operator = " " . strtoupper($operator) . " ";
        }

        return " " . $word . " " . $column . $operator . $this->quote($value);
    }

    public function insert($table, array $data)
    {
        $formattedColumns = [];
        $formattedValues = [];

        foreach ($data as $column => $value) {
            array_push($formattedColumns, $column);
            array_push($formattedValues, $this->quote($value));
        }

        $this->query .= "INSERT INTO $table (" . implode(', ', $formattedColumns) . ") VALUES (" . implode(', ', $formattedValues) . ")";

        return $this;
    }

    public function update($table, array $data)
    {
        $formattedSet = [];

        foreach ($data as $column => $value) {
            array_push($formattedSet, $column . "=" . $this->quote($value));
        }

        $this->query .= "UPDATE $table SET " . implode(', ', $formattedSet);

        return $this;
    }

    public function delete($table)
    {
        $this->query .= "DELETE FROM $table";
        return $this;
    }

    public function orderBy($data)
    {
        $formattedOrder = [];

        foreach ($data as $column => $order) {
            array_push($formattedOrder, $column . " " . strtoupper($order));
        }

        $this->query .= "ORDER BY " . implode(', ', $formattedOrder);

        return $this;
    }

    public function groupBy(array $columns)
    {
        $this->query .= "GROUP BY " . implode(', ', $columns);

        return $this;
    }

    public function quote($value)
    {
        if (is_string($value)) {
            $value = " '$value' ";
        }

        return $value;
    }

    public function exec($query = null)
    {
        if ($query !== null) {
            $this->query = $query;
        }

        $this->preparedStatement = $this->connection->prepare($this->query);
        $this->clearQuery();

        return $this->preparedStatement->execute();
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

    public function getpreparedStatement()
    {
        return $this->preparedStatement;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
