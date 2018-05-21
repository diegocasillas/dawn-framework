<?php 

namespace Dawn\Database;

use Dawn\App\App;
/**
 * Prepares queries and gets data from the database.
 */
class QueryBuilder
{
    /**
     * The application container instance.
     *
     * @var Dawn\App\App
     */
    protected $app;

    /**
     * The connection service instance.
     *
     * @var Dawn\Database\Connection
     */
    protected $connection;

    /**
     * The pagination service instance.
     *
     * @var Dawn\Database\Pagination
     */
    protected $pagination;

    /**
     * The model name to query.
     *
     * @var string
     */
    protected $model;

    /**
     * The query string being built.
     *
     * @var string
     */
    protected $query;

    /**
     * The prepared statement to query.
     *
     * @var [type]
     */
    protected $preparedStatement;

    /**
     * Query data array.
     *
     * @var array
     */
    protected $queryData;

    /**
     * Create a new Query Builder instance.
     *
     * @param Dawn\App\App $app
     * @param Dawn\Database\Connection $connection
     * @param Dawn\Database\Pagination $pagination
     */
    public function __construct(App $app = null, Connection $connection = null, Pagination $pagination = null)
    {
        $this->app = $app;
        $this->connection = $connection;
        $this->pagination = $pagination;
    }

    /**
     * Add a select string with the specified columns to the query.
     *
     * @param array $columns
     * @return $this
     */
    public function select($columns = [])
    {
        $this->query .= "SELECT ";

        if (!empty($columns)) {
            $this->query .= implode(', ', $columns);
        } else {
            $this->query .= '*';
        }

        $this->queryData['SELECT'] = $columns;

        return $this;
    }

    /**
     * Add a from string with the specified tables to the query.
     *
     * @param array $tables
     * @return $this
     */
    public function from($tables = [])
    {
        $this->query .= " FROM ";

        if (!empty($tables)) {
            $this->query .= implode(', ', $tables);
        } else {
            $this->query .= '*';
        }

        $this->queryData['FROM'] = $tables;

        return $this;
    }

    /**
     * Add a where string with the specified filter to the query.
     *
     * @param string $column
     * @param string $operator
     * @param mixed $value
     * @return $this
     */
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

    /**
     * Add a and string with the specified filter to the query.
     *
     * @param string $column
     * @param string $operator
     * @param mixed $value
     * @return $this
     */
    public function and($column, $operator, $value)
    {
        $this->query .= $this->compare('AND', $column, $operator, $value);

        return $this;
    }

    /**
     * Add a or string with the specified filter to the query.
     *
     * @param string $column
     * @param string $operator
     * @param mixed $value
     * @return $this
     */
    public function or($column, $operator, $value)
    {
        $this->query .= $this->compare('OR', $column, $operator, $value);

        return $this;
    }

    /**
     * Return a string with the specified filter.
     *
     * @param string $word
     * @param string $column
     * @param string $operator
     * @param mixed $value
     * @return string
     */
    public function compare($word, $column, $operator, $value)
    {
        $operator = strtolower($operator);

        if ($operator === 'is' || $operator === "like" || $operator === "not like" || $operator === "in" || $operator === "not in" || $operator === "between" || $operator === "not between") {
            $operator = " " . strtoupper($operator) . " ";
        }

        return " " . $word . " " . $column . $operator . $this->quote($value);
    }

    /**
     * Add a insert string to the query.
     *
     * @param string $table
     * @param array $data
     * @return $this
     */
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

    /**
     * Add a update string to the query.
     *
     * @param string $table
     * @param array $data
     * @return $this
     */
    public function update($table, array $data)
    {
        $formattedSet = [];

        foreach ($data as $column => $value) {
            array_push($formattedSet, $column . "=" . $this->quote($value));
        }

        $this->query .= "UPDATE $table SET " . implode(', ', $formattedSet);

        return $this;
    }

    /**
     * Add a delete string to the query.
     *
     * @param string $table
     * @return $this
     */
    public function delete($table)
    {
        $this->query .= "DELETE FROM $table";
        return $this;
    }

    /**
     * Add a order by string to the query.
     *
     * @param array $data
     * @return $this
     */
    public function orderBy(array $data)
    {
        $formattedOrder = [];

        foreach ($data as $column => $order) {
            array_push($formattedOrder, $column . " " . strtoupper($order));
        }

        $this->query .= "ORDER BY " . implode(', ', $formattedOrder);

        return $this;
    }

    /**
     * Add a group by string to the query.
     *
     * @param array $columns
     * @return void
     */
    public function groupBy(array $columns)
    {
        $this->query .= "GROUP BY " . implode(', ', $columns);

        return $this;
    }

    /**
     * Add quotation marks to the value if it is a string.
     *
     * @param mixed $value
     * @return mixed
     */
    public function quote($value)
    {
        if (is_string($value)) {
            $value = "'$value'";
        }

        return $value;
    }

    /**
     * Prepare, execute and clear the query.
     *
     * @param string $query
     * @return $this
     */
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

    /**
     * Get the query result by the specified mode.
     *
     * @param string $mode
     * @return mixed
     */
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

    /**
     * Get the column result.
     *
     * @return mixed
     */
    public function fetchColumn()
    {
        return $this->preparedStatement->fetchColumn();
    }

    /**
     * Get the query result by the specified mode.
     *
     * @param string $mode
     * @return mixed
     */
    public function get($mode = 'class')
    {
        $this->exec();

        return $this->fetch($mode);
    }

    /**
     * Get the last insert ID.
     *
     * @return int
     */
    public function lastInsertId()
    {
        return $this->connection->lastInsertId();
    }

    /**
     * Clear the current query and prepared statement.
     *
     * @return void
     */
    public function clear()
    {
        $this->clearQuery();
        $this->clearPreparedStatement();
    }

    /**
     * Clear the current query.
     *
     * @return void
     */
    public function clearQuery()
    {
        $this->query = null;
    }

    /**
     * Clear the current prepared statement.
     *
     * @return void
     */
    public function clearPreparedStatement()
    {
        $this->preparedStatement = null;
    }

    /**
     * Get the current query.
     *
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Get the current prepared statement.
     *
     * @return object
     */
    public function getPreparedStatement()
    {
        return $this->preparedStatement;
    }

    /**
     * Get the current connection instance.
     *
     * @return Dawn\Database\Connection
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * Set the model name.
     *
     * @param string $model
     * @return void
     */
    public function setModel($model)
    {
        $this->model = $model;
    }
}
