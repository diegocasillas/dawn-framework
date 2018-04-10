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

    public function insert($table, array $columns = [], array $values)
    {
        if (!empty($columns)) {
            $columnsString = "(" . implode(', ', $columns) . ")";
        }

        $this->query .= "INSERT INTO " . $table . $columnsString . " VALUES(" . $this->makeValuesString($table, $columns, $values) . ")";
        return $this;
    }

    public function stringOrNumber($table, $column)
    {
        $sql = "SELECT " . $column . " FROM " . $table;
        $statement = $this->connection->query($sql);
        // die(var_dump($sql));
        $meta = $statement->getColumnMeta(0);

        return $meta['native_type'];
    }

    public function makeValuesString($table, $columns, $values)
    {
        $valuesString = "";

        foreach ($values as $index => $value) {
            echo $value;
            var_dump($this->stringOrNumber($table, $columns[$index]));
            if ($this->stringOrNumber($table, $columns[$index]) === "number") {
                $valuesString .= "$value";
            } else {
                $valuesString .= "'$value'";
            }
        }
        echo $valuesString;
        die();
        return $valuesString;
    }

    public function exec($query = null)
    {
        if ($query !== null) {
            $this->query = $query;
        }

        $this->statement = $this->connection->prepare($this->query);
        $this->query = null;
        return $this->statement->execute();
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getStatement()
    {
        return $this->statement;
    }
}
