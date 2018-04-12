<?php 

namespace Dawn\Database;

class QueryBuilder
{
    protected $app;
    protected $connection;
    protected $pagination;
    protected $model;
    protected $query;
    protected $preparedStatement;
    protected $queryData;

    public function __construct(App $app = null, Connection $connection = null, Pagination $pagination = null)
    {
        $this->app = $app;
        $this->connection = $connection;
        $this->pagination = $pagination;
    }

    public function select($columns = '*')
    {
        $this->query .= "SELECT ";

        if (is_array($columns)) {
            $this->query .= implode(', ', $columns);
        } else {
            $this->query .= $columns;
        }

        $this->queryData['SELECT'] = $columns;

        return $this;
    }

    public function from($columns = '*')
    {
        $this->query .= " FROM ";

        if (is_array($columns)) {
            $this->query .= implode(', ', $columns);
        } else {
            $this->query .= $columns;
        }

        $this->queryData['FROM'] = $columns;

        return $this;
    }

    public function where($column, $operator, $value)
    {
        $this->query .= $this->compare('WHERE', $column, $operator, $value);

        $this->queryData['WHERE'] = [
            'column' => $column,
            'operator' => $operator,
            'value' => $value
        ];

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
            $value = "'$value'";
        }

        return $value;
    }

    public function exec($query = null)
    {
        if ($query !== null) {
            $this->query = $query;
        }

        $this->preparedStatement = $this->connection->prepare($this->query);
        $this->preparedStatement->execute();
        $this->clearQuery();

        return $this;
    }

    public function fetch($mode = 'class')
    {
        switch ($mode) {
            case 'class':
                $this->preparedStatement->setFetchMode($this->connection::FETCH_CLASS, $this->model);
                $result = $this->preparedStatement->fetchAll();

                break;

            case 'array':
                $result = $this->preparedStatement->fetchAll();

                break;

            case 'column':
                $result = $this->preparedStatement->fetchAll($this->connection::FETCH_COLUMN, 0);

                break;

        }

        if (count($result) === 1) {
            $result = $result[0];
        }

        return $result;
    }

    public function fetchColumn()
    {
        return $this->preparedStatement->fetchColumn();
    }

    public function get($mode = 'class')
    {
        $this->exec();

        return $this->fetch($mode);
    }

    public function lastInsertId()
    {
        return $this->connection->lastInsertId();
    }

    public function clearQuery()
    {
        $this->query = null;
    }

    public function clearPreparedStatement()
    {
        $this->preparedStatement = null;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getPreparedStatement()
    {
        return $this->preparedStatement;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }
}
